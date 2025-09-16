<?php
// Secure migration endpoint: import schema and apply migrations
// Protect with a token: set MIGRATE_TOKEN env var on the server or define in config.php (env preferred)

require_once __DIR__ . '/../includes/init.php';

header('Content-Type: text/plain');

$expected = getenv('MIGRATE_TOKEN') ?: null;
$token = $_GET['token'] ?? '';
if (!$expected || !hash_equals($expected, $token)) {
    http_response_code(403);
    echo "Forbidden\n";
    exit;
}

// 1) Ensure database and tables exist (idempotent)
try {
    // Connect without specifying DB to allow CREATE DATABASE
    $dsn = 'mysql:host=' . DB_HOST . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $sql = file_get_contents(__DIR__ . '/../sql/database.sql');
    $stmts = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
    foreach ($stmts as $s) { if ($s !== '') $pdo->exec($s); }
    echo "Schema import: OK\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo "Schema import failed: " . $e->getMessage() . "\n";
    exit;
}

// 2) Apply lightweight column migrations (idempotent checks)
try {
    $pdo2 = connectDB();
    if (!$pdo2) throw new RuntimeException('Cannot connect to database ' . DB_NAME);

    $db = DB_NAME;
    $table = 'users';
    $cols = [
        'gender' => "ALTER TABLE users ADD COLUMN gender VARCHAR(32) DEFAULT NULL",
        'education' => "ALTER TABLE users ADD COLUMN education JSON DEFAULT NULL",
        'country' => "ALTER TABLE users ADD COLUMN country VARCHAR(128) DEFAULT NULL",
    ];

    foreach ($cols as $col => $sql) {
        $stmt = $pdo2->prepare('SELECT COUNT(*) as cnt FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?');
        $stmt->execute([$db, $table, $col]);
        $r = $stmt->fetch();
        if ($r && (int)$r['cnt'] > 0) {
            echo "Column $col: exists\n";
            continue;
        }
        try { $pdo2->exec($sql); echo "Column $col: added\n"; }
        catch (Throwable $e) { echo "Column $col: failed - " . $e->getMessage() . "\n"; }
    }

    echo "Migration: finished\n";
} catch (Throwable $e) {
    http_response_code(500);
    echo "Migration failed: " . $e->getMessage() . "\n";
}
