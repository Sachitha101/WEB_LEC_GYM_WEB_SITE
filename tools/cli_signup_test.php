<?php
// CLI helper: fetch CSRF token and POST signup using same cookie jar to verify session/CSRF handling
$base = 'http://localhost/fitness_win11/api/auth.php';
$cookie = __DIR__ . '/cookies_cli.txt';

function curl_get($url, $cookie){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    $res = curl_exec($ch);
    if ($res === false) { echo 'Curl error: '.curl_error($ch)."\n"; }
    curl_close($ch);
    return $res;
}

function curl_post_json($url, $data, $cookie){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    $res = curl_exec($ch);
    if ($res === false) { echo 'Curl error: '.curl_error($ch)."\n"; }
    curl_close($ch);
    return $res;
}

echo "Fetching CSRF...\n";
$csrfRaw = curl_get($base . '?action=csrf', $cookie);
echo "CSRF response: $csrfRaw\n";
$j = json_decode($csrfRaw, true);
if (!isset($j['csrf_token'])) { echo "No csrf_token in response\n"; exit(1); }
$token = $j['csrf_token'];

$email = 'cli_test_' . time() . '@example.test';
$payload = json_encode([
    'name' => 'CLI Test',
    'email' => $email,
    'password' => 'P@ssw0rd123',
    'age' => 26,
    'gender' => 'Other',
    'education' => ['Highschool'],
    'country' => 'Testland',
    'csrf_token' => $token
]);

echo "Posting signup for $email ...\n";
$resp = curl_post_json($base . '?action=signup', $payload, $cookie);
echo "Signup response: $resp\n";

// show last inserted user id via DB (optional): try to connect and query
require_once __DIR__ . '/../config/config.php';
$pdo = connectDB();
if ($pdo) {
    $stmt = $pdo->prepare('SELECT id, email, name FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $u = $stmt->fetch();
    echo "DB lookup: ";
    var_export($u);
    echo "\n";
}

echo "Done.\n";
