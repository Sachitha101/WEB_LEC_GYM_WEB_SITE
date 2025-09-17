<?php
// cart.php — simple server-side cart persistence
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function out($ok, $data = null, $msg = ''){ echo json_encode(['success'=>$ok,'items'=>$data,'message'=>$msg]); exit; }

$pdo = connectDB();
if (!$pdo) out(false, null, 'DB connect failed');

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) out(true, []); // return empty for guests; client keeps localStorage

$action = $_GET['action'] ?? ($_POST['action'] ?? 'get');

try {
  if ($action === 'get') {
    $stmt = $pdo->prepare('SELECT id, product_id, product_name AS name, category, price, quantity, size, color FROM cart_items WHERE user_id = ? ORDER BY added_at DESC');
    $stmt->execute([$userId]);
    out(true, $stmt->fetchAll());
  }

  if ($action === 'save' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = file_get_contents('php://input');
    $body = json_decode($raw, true) ?? [];
    $items = $body['items'] ?? [];

    $pdo->beginTransaction();
    $pdo->prepare('DELETE FROM cart_items WHERE user_id = ?')->execute([$userId]);
    if (!empty($items)) {
      $ins = $pdo->prepare('INSERT INTO cart_items (user_id, product_id, product_name, category, price, quantity, size, color) VALUES (?,?,?,?,?,?,?,?)');
      foreach ($items as $it) {
        $ins->execute([
          $userId,
          $it['id'] ?? null,
          $it['name'] ?? 'Unknown',
          $it['category'] ?? null,
          (float)($it['price'] ?? 0),
          (int)($it['quantity'] ?? 1),
          $it['size'] ?? null,
          $it['color'] ?? null,
        ]);
      }
    }
    $pdo->commit();
    out(true, null, 'saved');
  }

  http_response_code(400);
  out(false, null, 'bad request');
} catch (Exception $e) {
  if ($pdo->inTransaction()) $pdo->rollBack();
  http_response_code(500);
  out(false, null, 'error: '.$e->getMessage());
}
