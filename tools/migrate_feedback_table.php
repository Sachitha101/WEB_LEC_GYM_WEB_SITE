<?php
// One-click migration for feedback table to new schema
// Run this in the browser: /fitness_win11/tools/migrate_feedback_table.php
// Safe for shared hosting; idempotent where possible.

require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

function p($msg){ echo htmlspecialchars($msg) . "<br/>\n"; }
function run($pdo, $sql, $params = []){
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  return $stmt;
}

header('Content-Type: text/html; charset=utf-8');
echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
echo '<div style="font-family:system-ui,Segoe UI,Roboto,sans-serif; max-width: 900px; margin: 24px auto; padding: 16px; border:1px solid #e5e7eb; border-radius:12px;">';
echo '<h2>Feedback Table Migration</h2>';

try {
  $pdo = connectDB();
  if (!$pdo) throw new Exception('DB connect failed');

  // Check if feedback table exists
  $exists = run($pdo, "SHOW TABLES LIKE 'feedback'")->fetch();
  if (!$exists) {
    p('feedback table not found — creating from scratch...');
    $sql = "CREATE TABLE IF NOT EXISTS feedback (
      id INT AUTO_INCREMENT PRIMARY KEY,
      user_id INT NULL,
      category ENUM('feature','general','support','issue') NOT NULL DEFAULT 'general',
      subject VARCHAR(191) NULL,
      description LONGTEXT NOT NULL,
      priority ENUM('low','medium','high') NULL,
      status ENUM('open','in_progress','resolved') NOT NULL DEFAULT 'open',
      assigned_to VARCHAR(191) NULL,
      attachment_path VARCHAR(255) NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      INDEX ix_user (user_id),
      INDEX ix_category_status (category, status),
      CONSTRAINT fk_feedback_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $pdo->exec($sql);
    p('Created feedback table.');
    echo '</div>'; exit;
  }

  p('feedback table found — checking columns...');
  $columns = [];
  foreach (run($pdo, 'DESCRIBE feedback') as $row) { $columns[$row['Field']] = $row; }

  // Add columns if missing
  $alter = [];
  if (!isset($columns['category'])) $alter[] = "ADD COLUMN category ENUM('feature','general','support','issue') NOT NULL DEFAULT 'general' AFTER user_id";
  if (!isset($columns['subject'])) $alter[] = "ADD COLUMN subject VARCHAR(191) NULL AFTER category";
  if (!isset($columns['description'])) $alter[] = "ADD COLUMN description LONGTEXT NULL AFTER subject";
  if (!isset($columns['priority'])) $alter[] = "ADD COLUMN priority ENUM('low','medium','high') NULL AFTER description";
  if (!isset($columns['status'])) $alter[] = "ADD COLUMN status ENUM('open','in_progress','resolved') NOT NULL DEFAULT 'open' AFTER priority";
  if (!isset($columns['assigned_to'])) $alter[] = "ADD COLUMN assigned_to VARCHAR(191) NULL AFTER status";
  if (!isset($columns['attachment_path'])) $alter[] = "ADD COLUMN attachment_path VARCHAR(255) NULL AFTER assigned_to";
  if (!isset($columns['updated_at'])) $alter[] = "ADD COLUMN updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER created_at";

  if ($alter) {
    $sql = 'ALTER TABLE feedback ' . implode(', ', $alter);
    $pdo->exec($sql);
    p('Added missing columns.');
  } else {
    p('All required columns already exist.');
  }

  // Ensure column types for existing columns (best-effort)
  // Modify to correct ENUMs if needed
  $mod = [];
  if (isset($columns['category']) && stripos($columns['category']['Type'], "enum('feature','general','support','issue')") === false) {
    $mod[] = "MODIFY COLUMN category ENUM('feature','general','support','issue') NOT NULL DEFAULT 'general'";
  }
  if (isset($columns['priority']) && stripos($columns['priority']['Type'], "enum('low','medium','high')") === false) {
    $mod[] = "MODIFY COLUMN priority ENUM('low','medium','high') NULL";
  }
  if (isset($columns['status']) && stripos($columns['status']['Type'], "enum('open','in_progress','resolved')") === false) {
    $mod[] = "MODIFY COLUMN status ENUM('open','in_progress','resolved') NOT NULL DEFAULT 'open'";
  }
  if ($mod) {
    $pdo->exec('ALTER TABLE feedback ' . implode(', ', $mod));
    p('Adjusted column types to expected ENUMs.');
  }

  // Indexes
  $idx = [];
  foreach (run($pdo, 'SHOW INDEX FROM feedback') as $row) { $idx[$row['Key_name']] = true; }
  $toIndex = [];
  if (empty($idx['ix_user'])) $toIndex[] = 'ADD INDEX ix_user (user_id)';
  if (empty($idx['ix_category_status'])) $toIndex[] = 'ADD INDEX ix_category_status (category, status)';
  if ($toIndex) {
    $pdo->exec('ALTER TABLE feedback ' . implode(', ', $toIndex));
    p('Created missing indexes.');
  }

  // Backfill description from legacy `feedback` column if present
  if (isset($columns['feedback'])) {
    p('Legacy column `feedback` detected — backfilling `description`...');
    $pdo->exec("UPDATE feedback SET description = COALESCE(NULLIF(description,''), feedback) WHERE (description IS NULL OR description='') AND feedback IS NOT NULL");
  }

  // Defaults for new columns
  $pdo->exec("UPDATE feedback SET category = COALESCE(category, 'general') WHERE category IS NULL");
  $pdo->exec("UPDATE feedback SET status = COALESCE(status, 'open') WHERE status IS NULL");
  // Set a default subject when missing
  $pdo->exec("UPDATE feedback SET subject = IFNULL(subject, LEFT(COALESCE(description,''), 80)) WHERE subject IS NULL");

  p('Migration complete.');
  echo '<div style="margin-top:12px; padding:10px; background:#ecfdf5; border:1px solid #a7f3d0; border-radius:8px;">Success ✅ You can close this tab.</div>';
} catch (Exception $e) {
  http_response_code(500);
  p('Migration failed: ' . $e->getMessage());
  echo '<div style="margin-top:12px; padding:10px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px;">Failed ❌ Check PHP error logs.</div>';
}

echo '</div>'; 