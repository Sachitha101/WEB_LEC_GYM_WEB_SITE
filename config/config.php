<?php
<?php
/*
Database module (extracted)
Roles: Database Manager, Backend Developer
Voting note: DB Manager owns this module; config/config.php will include it.
*/

if (!defined('DB_HOST')) {
    // Default values for local XAMPP dev — change to match your environment
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'fitness_db');
    define('DB_USER', 'root');
    define('DB_PASS', ''); // XAMPP default is empty password
}

// Create and return a PDO connection (singleton)
function connectDB() {
    static $pdo = null;
    if ($pdo !== null) return $pdo;

    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        // Log for developers, return null so callers can handle the error gracefully
        error_log('DB connection failed: ' . $e->getMessage());
        return null;
    }
}
