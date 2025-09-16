<?php
// Migration: add avatar column to users table if missing
require_once __DIR__ . '/../config/config.php';
$pdo = connectDB();
$col = $pdo->query("SHOW COLUMNS FROM users LIKE 'avatar'")->fetch();
if (!$col) {
    $pdo->exec("ALTER TABLE users ADD avatar VARCHAR(255) DEFAULT NULL");
    echo "Added avatar column to users table.\n";
} else {
    echo "Avatar column already exists.\n";
}
echo "Migration finished.\n";