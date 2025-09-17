<?php
require_once __DIR__ . '/../includes/init.php';

header('Content-Type: text/plain; charset=utf-8');

$pdo = connectDB();
if (!$pdo) {
  echo "DB connection failed.\n";
  exit(1);
}

$dbName = $pdo->query('select database()')->fetchColumn();
echo "# Database: {$dbName}\n\n";

$tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME")->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $t) {
  echo "## Table: {$t}\n\n";
  $cols = $pdo->prepare("
    SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE, COLUMN_DEFAULT, COLUMN_KEY, EXTRA
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ?
    ORDER BY ORDINAL_POSITION
  ");
  $cols->execute([$t]);
  echo "| Column | Type | Null | Default | Key | Extra |\n";
  echo "|-------|------|------|---------|-----|-------|\n";
  while ($c = $cols->fetch(PDO::FETCH_ASSOC)) {
    printf("| %s | %s | %s | %s | %s | %s |\n",
      $c['COLUMN_NAME'],
      $c['COLUMN_TYPE'],
      $c['IS_NULLABLE'],
      $c['COLUMN_DEFAULT'] === null ? '—' : $c['COLUMN_DEFAULT'],
      $c['COLUMN_KEY'] ?: '—',
      $c['EXTRA'] ?: '—'
    );
  }
  echo "\n";
}

$fk = $pdo->query("
  SELECT
    kcu.TABLE_NAME, kcu.COLUMN_NAME, kcu.REFERENCED_TABLE_NAME, kcu.REFERENCED_COLUMN_NAME,
    rc.UPDATE_RULE, rc.DELETE_RULE, kcu.CONSTRAINT_NAME
  FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu
  JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS rc
    ON rc.CONSTRAINT_SCHEMA = kcu.CONSTRAINT_SCHEMA
   AND rc.CONSTRAINT_NAME = kcu.CONSTRAINT_NAME
  WHERE kcu.CONSTRAINT_SCHEMA = DATABASE()
    AND kcu.REFERENCED_TABLE_NAME IS NOT NULL
  ORDER BY kcu.TABLE_NAME, kcu.COLUMN_NAME
");
echo "## Foreign Keys\n\n";
echo "| Table | Column | Ref Table | Ref Column | On Update | On Delete | Name |\n";
echo "|------|--------|-----------|------------|-----------|-----------|------|\n";
while ($r = $fk->fetch(PDO::FETCH_ASSOC)) {
  printf("| %s | %s | %s | %s | %s | %s | %s |\n",
    $r['TABLE_NAME'], $r['COLUMN_NAME'], $r['REFERENCED_TABLE_NAME'], $r['REFERENCED_COLUMN_NAME'],
    $r['UPDATE_RULE'], $r['DELETE_RULE'], $r['CONSTRAINT_NAME']
  );
}
