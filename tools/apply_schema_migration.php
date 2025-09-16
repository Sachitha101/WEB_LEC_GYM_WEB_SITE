<?php
require_once __DIR__ . '/../config/config.php';

$pdo = connectDB();
if (!$pdo) { echo "Cannot connect to DB\n"; exit(1); }

$db = DB_NAME;
$table = 'users';
$cols = [
    'gender' => "ALTER TABLE users ADD COLUMN gender VARCHAR(32) DEFAULT NULL",
    'education' => "ALTER TABLE users ADD COLUMN education JSON DEFAULT NULL",
    'country' => "ALTER TABLE users ADD COLUMN country VARCHAR(128) DEFAULT NULL",
];

foreach ($cols as $col => $sql) {
    $stmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_name = ?');
    $stmt->execute([$db, $table, $col]);
    $r = $stmt->fetch();
    if ($r && $r['cnt'] > 0) {
        echo "Column $col already exists\n";
        continue;
    }
    try {
        $pdo->exec($sql);
        echo "Added column $col\n";
    } catch (Exception $e) {
        echo "Failed to add $col: " . $e->getMessage() . "\n";
    }
}

echo "Migration finished\n";
