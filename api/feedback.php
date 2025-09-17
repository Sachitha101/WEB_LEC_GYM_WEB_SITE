<?php
// Feedback & Support endpoint
// Accepts JSON (application/json) or multipart/form-data for attachments.
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $pdo = connectDB();
        if (!$pdo) throw new Exception('DB unavailable');
        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Not authenticated']);
            exit;
        }
        $category = strtolower(trim($_GET['category'] ?? ''));
        $allowed = ['feature','general','support','issue'];
        $limit = max(1, min(100, (int)($_GET['limit'] ?? 20)));
        if ($category && !in_array($category, $allowed)) $category = '';
        if ($category) {
            $stmt = $pdo->prepare('SELECT id, category, subject, description, priority, status, assigned_to, attachment_path, created_at, updated_at FROM feedback WHERE category = ? ORDER BY created_at DESC LIMIT ?');
            $stmt->execute([$category, $limit]);
        } else {
            $stmt = $pdo->prepare('SELECT id, category, subject, description, priority, status, assigned_to, attachment_path, created_at, updated_at FROM feedback ORDER BY created_at DESC LIMIT ?');
            $stmt->execute([$limit]);
        }
        echo json_encode(['success' => true, 'items' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        exit;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to list feedback']);
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$isMultipart = stripos($contentType, 'multipart/form-data') !== false;

// Parse input
if ($isMultipart) {
    $category = strtolower(trim($_POST['category'] ?? 'general'));
    $subject = trim($_POST['subject'] ?? null);
    $description = trim($_POST['description'] ?? ($_POST['feedback'] ?? ''));
    $priority = strtolower(trim($_POST['priority'] ?? '')) ?: null;
} else {
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true) ?? [];
    $category = strtolower(trim($data['category'] ?? 'general'));
    $subject = trim($data['subject'] ?? null);
    $description = trim($data['description'] ?? ($data['feedback'] ?? ''));
    $priority = strtolower(trim($data['priority'] ?? '')) ?: null;
}

$allowedCategories = ['feature','general','support','issue'];
if (!in_array($category, $allowedCategories)) $category = 'general';
if (empty($description)) {
    echo json_encode(['success' => false, 'message' => 'Description is required']);
    exit;
}

$userId = $_SESSION['user_id'] ?? null;
$attachmentPath = null;

// Handle attachment if multipart (pick first available file field)
if ($isMultipart && !empty($_FILES)) {
    foreach ($_FILES as $file) {
        if (!empty($file['name'])) {
            $uploadDir = __DIR__ . '/../uploads/feedback';
            @mkdir($uploadDir, 0755, true);
            $safeName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', is_array($file['name']) ? $file['name'][0] : $file['name']);
            $tmpName = is_array($file['tmp_name']) ? $file['tmp_name'][0] : $file['tmp_name'];
            $dest = $uploadDir . '/' . $safeName;
            if (is_uploaded_file($tmpName)) {
                if (move_uploaded_file($tmpName, $dest)) {
                    $attachmentPath = 'uploads/feedback/' . $safeName;
                }
            }
            break;
        }
    }
}

try {
    $pdo = connectDB();
    if (!$pdo) throw new Exception('DB unavailable');

    $stmt = $pdo->prepare('INSERT INTO feedback (user_id, category, subject, description, priority, status, assigned_to, attachment_path, created_at) VALUES (?,?,?,?,?,"open",NULL,?, NOW())');
    $stmt->execute([$userId, $category, $subject, $description, $priority, $attachmentPath]);
    $id = (int)$pdo->lastInsertId();

    echo json_encode([
        'success' => true,
        'message' => 'Feedback submitted',
        'data' => [ 'id' => $id, 'status' => 'open' ]
    ]);
    exit;
} catch (Exception $e) {
    // Fallback minimal log to file
    $file = __DIR__ . '/../data/feedback.log';
    @mkdir(dirname($file), 0755, true);
    $entry = date('c') . ' | ' . ($category ?: 'general') . ' | ' . ($_SESSION['user_email'] ?? 'anon') . ' | ' . str_replace(["\r","\n"], ' ', $description) . "\n";
    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
    echo json_encode(['success' => true, 'message' => 'Feedback saved (offline mode)']);
    exit;
}