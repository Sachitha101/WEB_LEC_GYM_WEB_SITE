<?php
require_once __DIR__ . '/../includes/init.php';
$pdo = connectDB(); if (!$pdo) {fwrite(STDERR, "DB connection failed\n"); exit(1);} 

$tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = DATABASE()")->fetchAll(PDO::FETCH_COLUMN);
$colsStmt = $pdo->prepare("SELECT COLUMN_NAME, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? ORDER BY ORDINAL_POSITION");
$fks = $pdo->query("SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = DATABASE() AND REFERENCED_TABLE_NAME IS NOT NULL")->fetchAll(PDO::FETCH_ASSOC);

echo "digraph ERD {\n  graph [rankdir=LR, splines=true, bgcolor=white];\n  node [shape=plaintext, fontname=\"Segoe UI\", fontsize=12];\n";

foreach ($tables as $t) {
  $colsStmt->execute([$t]); $cols = $colsStmt->fetchAll(PDO::FETCH_ASSOC);
  echo "  \"$t\" [label=<\n    <table border='0' cellborder='1' cellspacing='0' cellpadding='6'>\n";
  echo "      <tr><td bgcolor='#e8f0ff' align='left'><b>$t</b></td></tr>\n";
  foreach ($cols as $c) {
    $pk = ($c['COLUMN_KEY'] === 'PRI') ? " <font color='#0ea5e9'>(PK)</font>" : "";
    echo "      <tr><td align='left'>{$c['COLUMN_NAME']}$pk</td></tr>\n";
  }
  echo "    </table>\n  >];\n";
}
foreach ($fks as $fk) {
  echo "  \"{$fk['TABLE_NAME']}\" -> \"{$fk['REFERENCED_TABLE_NAME']}\" [color=\"#64748b\"];\n";
}
echo "}\n";
