<?php
// membership.php — set or get membership tier for logged-in user
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function out($ok, $msg = '', $data = []){ echo json_encode(['success'=>$ok,'message'=>$msg,'data'=>$data]); exit; }

$pdo = connectDB();
if (!$pdo) out(false, 'DB connect failed');

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) out(false, 'Not authenticated');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
  $tier = null;
  $stmt = $pdo->prepare('SELECT tier FROM user_memberships WHERE user_id = ?');
  $stmt->execute([$userId]);
  $row = $stmt->fetch();
  if ($row) $tier = $row['tier'];
  out(true, 'ok', ['tier'=>$tier]);
}

if ($method === 'POST') {
  $raw = file_get_contents('php://input');
  $body = json_decode($raw, true) ?? [];
  $tier = strtolower(trim($body['tier'] ?? ''));
  if (!in_array($tier, ['basic','premium','elite'])) out(false, 'Invalid tier');

  // upsert
  $pdo->beginTransaction();
  $exists = $pdo->prepare('SELECT id FROM user_memberships WHERE user_id = ?');
  $exists->execute([$userId]);
  if ($exists->fetch()) {
    $upd = $pdo->prepare('UPDATE user_memberships SET tier = ?, updated_at = NOW() WHERE user_id = ?');
    $upd->execute([$tier, $userId]);
  } else {
    $ins = $pdo->prepare('INSERT INTO user_memberships (user_id, tier, started_at) VALUES (?,?, NOW())');
    $ins->execute([$userId, $tier]);
  }
  $pdo->commit();

  // stash in session for quick theming
  $_SESSION['membership_tier'] = $tier;
  out(true, 'saved', ['tier'=>$tier]);
}

http_response_code(405);
out(false, 'Method not allowed');
