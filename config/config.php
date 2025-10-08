<?php
/*

This configuration contains DB credentials and helper functions. Owner: DB Manager + Backend.
Voting note: changes to DB constants require DevOps/DB approval and should be reviewed before deployment.
*/
// Database configuration using PDO
// Auto-switch to local DB when running on localhost/CLI or when APP_ENV=local
$serverName = $_SERVER['SERVER_NAME'] ?? '';
$remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
$isLocalEnv = (getenv('APP_ENV') === 'local')
    || (PHP_SAPI === 'cli')
    || ($serverName === 'localhost')
    || ($remoteAddr === '127.0.0.1')
    || ($remoteAddr === '::1');

if ($isLocalEnv) {
    // Local XAMPP defaults (override with env vars if set)
    define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
    define('DB_PORT', getenv('DB_PORT') ?: '3306');
    // Use same DB name locally unless overridden
    define('DB_NAME', getenv('DB_NAME') ?: 'fitness_db');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') ?: ''); // XAMPP default empty
} else {
    // Hosting defaults (InfinityFree) — can be overridden via env vars
    define('DB_HOST', getenv('DB_HOST') ?: 'sql204.infinityfree.com');
    define('DB_PORT', getenv('DB_PORT') ?: '3306');
    define('DB_NAME', getenv('DB_NAME') ?: 'if0_39961734_fitness_db');
    define('DB_USER', getenv('DB_USER') ?: 'if0_39961734');
    define('DB_PASS', getenv('DB_PASS') ?: 'iYAerzEaNfDUgd');
}

date_default_timezone_set('UTC');

// Create a PDO connection and return it
function connectDB() {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $port = defined('DB_PORT') ? DB_PORT : '3306';
    $dsn = 'mysql:host=' . DB_HOST . ';port=' . $port . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        error_log('DB connection failed: ' . $e->getMessage());
        return null;
    }
}

// Simple input sanitizer
function sanitizeInput($v) {
    return trim(htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
}

// CSRF token helpers
function generate_csrf_token() {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}