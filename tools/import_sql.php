<?php
// import SQL file through PDO (connect to server without database)
require_once __DIR__ . '/../config/config.php';
$dsn = 'mysql:host=' . DB_HOST . ';charset=utf8mb4';
try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $sql = file_get_contents(__DIR__ . '/../sql/database.sql');
    // Split on ; statements, but keep it simple for this small script
    $stmts = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
    foreach ($stmts as $s) {
        if ($s === '') continue;
        $pdo->exec($s);
    }
    echo "Import completed\n";
} catch (Exception $e) {
    echo 'Import failed: ' . $e->getMessage() . "\n";
}
