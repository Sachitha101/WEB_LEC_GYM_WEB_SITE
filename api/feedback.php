<?php
// Simple feedback endpoint used by frontend. Accepts JSON POST and stores feedback.
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];
$feedback = trim($data['feedback'] ?? '');
if (empty($feedback)) {
    echo json_encode(['success' => false, 'message' => 'Feedback is required']);
    exit;
}

$pdo = connectDB();
if ($pdo) {
    try {
        $stmt = $pdo->prepare('INSERT INTO feedback (user_id, feedback, created_at) VALUES (?, ?, NOW())');
        $userId = $_SESSION['user_id'] ?? null;
        $stmt->execute([$userId, $feedback]);
        echo json_encode(['success' => true, 'message' => 'Thanks for your feedback']);
        exit;
    } catch (Exception $e) {
        // fall through to file fallback
        error_log('Feedback DB insert failed: ' . $e->getMessage());
    }
}

// Fallback: append to a local file
$file = __DIR__ . '/../data/feedback.log';
@mkdir(dirname($file), 0755, true);
$entry = date('c') . ' | ' . ($_SESSION['user_email'] ?? 'anon') . ' | ' . str_replace(["\r", "\n"], [' ', ' '], $feedback) . "\n";
file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
echo json_encode(['success' => true, 'message' => 'Thanks for your feedback (saved)']);
exit;