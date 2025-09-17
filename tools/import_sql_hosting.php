<?php
// Import SQL into an existing database (shared hosting friendly)
// Usage: php tools/import_sql_hosting.php sql/database_hosting.sql
require_once __DIR__ . '/../config/config.php';

if ($argc < 2) {
    echo "Usage: php tools/import_sql_hosting.php <path-to-sql>\n";
    exit(1);
}
$file = $argv[1];
if (!is_file($file)) {
    echo "File not found: $file\n";
    exit(1);
}

try {
    // Connect directly to the configured database
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $sql = file_get_contents($file);

    // Remove CREATE DATABASE / USE statements just in case
    $sql = preg_replace('/^\s*CREATE\s+DATABASE[\s\S]*?;\s*$/im', '', $sql);
    $sql = preg_replace('/^\s*USE\s+[^;]+;\s*$/im', '', $sql);

    $stmts = array_filter(array_map('trim', preg_split('/;\s*\n/', $sql)));
    foreach ($stmts as $s) {
        if ($s === '') continue;
        $pdo->exec($s);
    }
    echo "Import completed into '" . DB_NAME . "'\n";
} catch (Exception $e) {
    echo 'Import failed: ' . $e->getMessage() . "\n";
    exit(1);
}
?>
