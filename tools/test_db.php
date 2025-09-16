<?php
require_once __DIR__ . '/../config/config.php';
$pdo = connectDB();
if ($pdo) {
    echo "OK: Connected to database\n";
    // show one sample query
    try {
        $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
        $res = $stmt->fetchAll();
        echo "Tables like 'users': " . count($res) . "\n";
    } catch (Exception $e) {
        echo 'Query error: ' . $e->getMessage() . "\n";
    }
} else {
    echo "ERROR: Could not connect to DB.\n";
}
