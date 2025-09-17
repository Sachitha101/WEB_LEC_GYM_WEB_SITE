<?php
// Minimal admin endpoint to update feedback status/assignment
// POST: { id, status?, assigned_to? }
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Simple role check: require user to be logged in and marked as admin in session
if (empty($_SESSION['user_id']) || empty($_SESSION['is_admin'])) {
  http_response_code(403);
  echo json_encode(['success'=>false,'message'=>'Forbidden']);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success'=>false,'message'=>'Method not allowed']);
  exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true) ?? [];
$id = isset($data['id']) ? (int)$data['id'] : 0;
$status = isset($data['status']) ? strtolower(trim($data['status'])) : null;
$assigned = isset($data['assigned_to']) ? trim($data['assigned_to']) : null;

if ($id <= 0) {
  echo json_encode(['success'=>false,'message'=>'Invalid id']);
  exit;
}

try {
  $pdo = connectDB();
  if (!$pdo) throw new Exception('DB unavailable');

  $allowed = ['open','in_progress','resolved'];
  $fields = [];
  $params = [];
  if ($status !== null) {
    if (!in_array($status, $allowed)) throw new Exception('Invalid status');
    $fields[] = 'status = ?';
    $params[] = $status;
  }
  if ($assigned !== null) {
    $fields[] = 'assigned_to = ?';
    $params[] = $assigned;
  }
  if (!$fields) throw new Exception('Nothing to update');

  $params[] = $id;
  $sql = 'UPDATE feedback SET ' . implode(', ', $fields) . ', updated_at = NOW() WHERE id = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);

  echo json_encode(['success'=>true,'message'=>'Updated']);
} catch (Exception $e) {
  http_response_code(400);
  echo json_encode(['success'=>false,'message'=>$e->getMessage()]);
}