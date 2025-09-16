<?php
// account.php — handle profile update and avatar upload
/*
Project Roles (Vote to assign):
1. API Integration Specialist
2. Backend Developer (PHP)
3. Database Manager
4. Authentication & Security Lead
5. DevOps & Deployment

This API file maps to API Integration, Backend and DB responsibilities.
Voting note: assign an API lead and a backup Backend Developer; require DB sign-off for schema changes.
*/
require_once __DIR__ . '/../config/config.php';
session_start();
header('Content-Type: application/json');

if (empty($_SESSION['user_id'])) {
    echo json_encode(['success'=>false,'message'=>'Not authenticated']);
    exit;
}

$userId = $_SESSION['user_id'];
$pdo = connectDB();

// Handle avatar upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $gender = sanitizeInput($_POST['gender'] ?? '');
    $country = sanitizeInput($_POST['country'] ?? '');
    $avatarPath = $_SESSION['user_avatar'] ?? '';

    // Handle avatar file
    if (!empty($_FILES['avatar']['name'])) {
        $file = $_FILES['avatar'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if (!in_array($ext, $allowed)) {
            echo json_encode(['success'=>false,'message'=>'Invalid avatar file type']);
            exit;
        }
        if ($file['size'] > 4*1024*1024) { // allow up to 4MB pre-resize to be lenient, we'll compress
            echo json_encode(['success'=>false,'message'=>'Avatar file too large (max 4MB)']);
            exit;
        }

        // Move to temp path first
        $tmpName = 'avatar_upload_' . $userId . '_' . time() . '.' . $ext;
        $tmpPath = __DIR__ . '/../uploads/' . $tmpName;
        if (!move_uploaded_file($file['tmp_name'], $tmpPath)) {
            echo json_encode(['success'=>false,'message'=>'Failed to upload avatar']);
            exit;
        }

        // Resize & center-crop to square thumbnail
        $targetSize = 256; // px
        $imageInfo = @getimagesize($tmpPath);
        if (!$imageInfo) {
            @unlink($tmpPath);
            echo json_encode(['success'=>false,'message'=>'Unsupported image file']);
            exit;
        }
        [$width, $height, $type] = $imageInfo;

        switch ($type) {
            case IMAGETYPE_JPEG: $srcImg = @imagecreatefromjpeg($tmpPath); break;
            case IMAGETYPE_PNG:  $srcImg = @imagecreatefrompng($tmpPath); break;
            case IMAGETYPE_GIF:  $srcImg = @imagecreatefromgif($tmpPath); break;
            case IMAGETYPE_WEBP: if (function_exists('imagecreatefromwebp')) { $srcImg = @imagecreatefromwebp($tmpPath); } else { $srcImg = false; } break;
            default: $srcImg = false; break;
        }
        if (!$srcImg) {
            @unlink($tmpPath);
            echo json_encode(['success'=>false,'message'=>'Failed to process image']);
            exit;
        }

        // Determine crop square
        $side = min($width, $height);
        $srcX = (int) max(0, ($width  - $side) / 2);
        $srcY = (int) max(0, ($height - $side) / 2);

        $dstImg = imagecreatetruecolor($targetSize, $targetSize);
        // Preserve transparency for PNG/GIF when output supports it
        $preserveAlpha = in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF], true);
        if ($preserveAlpha) {
            imagealphablending($dstImg, false);
            imagesavealpha($dstImg, true);
            $transparent = imagecolorallocatealpha($dstImg, 0, 0, 0, 127);
            imagefilledrectangle($dstImg, 0, 0, $targetSize, $targetSize, $transparent);
        } else {
            // Fill white background for non-alpha images
            $white = imagecolorallocate($dstImg, 255, 255, 255);
            imagefilledrectangle($dstImg, 0, 0, $targetSize, $targetSize, $white);
        }
        imagealphablending($dstImg, true);
        imagecopyresampled($dstImg, $srcImg, 0, 0, $srcX, $srcY, $targetSize, $targetSize, $side, $side);

        // Save as WebP if supported, otherwise JPEG
        $outExt = function_exists('imagewebp') ? 'webp' : 'jpg';
        $newName = 'avatar_' . $userId . '_' . time() . '.' . $outExt;
        $finalPath = __DIR__ . '/../uploads/' . $newName;
        $ok = false;
        if ($outExt === 'webp') {
            // Quality 80 is a good balance
            $ok = @imagewebp($dstImg, $finalPath, 80);
        } else {
            // Ensure background is opaque when saving JPEG
            if ($preserveAlpha) {
                $opaque = imagecreatetruecolor($targetSize, $targetSize);
                $white = imagecolorallocate($opaque, 255, 255, 255);
                imagefilledrectangle($opaque, 0, 0, $targetSize, $targetSize, $white);
                imagecopy($opaque, $dstImg, 0, 0, 0, 0, $targetSize, $targetSize);
                $ok = @imagejpeg($opaque, $finalPath, 82);
                imagedestroy($opaque);
            } else {
                $ok = @imagejpeg($dstImg, $finalPath, 82);
            }
        }

        imagedestroy($dstImg);
        imagedestroy($srcImg);
        @unlink($tmpPath);

        if (!$ok) {
            echo json_encode(['success'=>false,'message'=>'Failed to save processed avatar']);
            exit;
        }
        $avatarPath = 'uploads/' . $newName;
    }

    // Update user profile
    $stmt = $pdo->prepare('UPDATE users SET name=?, age=?, gender=?, country=?, avatar=? WHERE id=?');
    $stmt->execute([$name, $age, $gender, $country, $avatarPath, $userId]);

    // Update session
    $_SESSION['user_name'] = $name;
    $_SESSION['user_age'] = $age;
    $_SESSION['user_gender'] = $gender;
    $_SESSION['user_country'] = $country;
    $_SESSION['user_avatar'] = $avatarPath;

    echo json_encode(['success'=>true,'message'=>'Profile updated','avatar'=>$avatarPath]);
    exit;
}

echo json_encode(['success'=>false,'message'=>'Invalid request']);