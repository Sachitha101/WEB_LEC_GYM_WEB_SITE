<?php
// booking.php — persist a booking to workout_sessions table
// Expected POST JSON: { sessionType, trainer, sessionDate, sessionTime, duration, specialRequests }
// Requires logged-in session
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
session_start();

function respond($ok, $msg, $data=null){ echo json_encode(['success'=>$ok,'message'=>$msg,'data'=>$data]); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  respond(false, 'Method not allowed');
}

if (empty($_SESSION['user_id'])) {
  http_response_code(401);
  respond(false, 'Not authenticated');
}

$raw = file_get_contents('php://input');
$input = json_decode($raw, true) ?? [];

$sessionType = trim($input['sessionType'] ?? '');
$trainer     = trim($input['trainer'] ?? '');
$sessionDate = trim($input['sessionDate'] ?? '');
$sessionTime = trim($input['sessionTime'] ?? '');
$duration    = (int)($input['duration'] ?? 60);
$notes       = trim($input['specialRequests'] ?? '');

if (!$sessionType || !$trainer || !$sessionDate || !$sessionTime) {
  respond(false, 'Please fill all required fields');
}

// Validate date & time format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $sessionDate)) respond(false, 'Invalid date');
if (!preg_match('/^\d{2}:\d{2}$/', $sessionTime)) respond(false, 'Invalid time');

try {
  $pdo = connectDB();
  if (!$pdo) respond(false, 'DB connection failed');

  // Insert into workout_sessions; encode details into notes/exercises
  $details = ['type'=>$sessionType,'trainer'=>$trainer,'time'=>$sessionTime];
  $stmt = $pdo->prepare('INSERT INTO workout_sessions (user_id, plan_id, session_date, duration_minutes, exercises_completed, notes, rating, created_at) VALUES (?,?,?,?,?,?,NULL, NOW())');
  $ok = $stmt->execute([
    $_SESSION['user_id'],
    null,
    $sessionDate,
    $duration,
    json_encode($details),
    $notes
  ]);
  if ($ok) {
    respond(true, 'Booking saved', ['id'=>$pdo->lastInsertId()]);
  }
  respond(false, 'Failed to save booking');
} catch (Exception $e) {
  respond(false, 'Error: '.$e->getMessage());
}
