<?php
// Database Setup Script
// This script will create the fitness_db database and tables

require_once __DIR__ . '/../config/config.php';

try {
    // Create database if it doesn't exist
    $pdo = new PDO('mysql:host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    // Create database
    $pdo->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ' CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "✓ Database '" . DB_NAME . "' is ready\n";

    // Connect to the target DB
    $pdo = connectDB();
    if (!$pdo) throw new PDOException('Could not connect to ' . DB_NAME);

    // USERS (align with api/auth.php and sql/database.sql)
    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(191) NOT NULL,
  email VARCHAR(191) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  age INT DEFAULT 0,
  gender VARCHAR(32) DEFAULT NULL,
  education JSON DEFAULT NULL,
  country VARCHAR(128) DEFAULT NULL,
  avatar VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
SQL;
    $pdo->exec($sql);
    echo "✓ users table OK\n";

    // OAUTH PROVIDERS
    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS oauth_providers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  provider VARCHAR(64) NOT NULL,
  provider_id VARCHAR(191) NOT NULL,
  provider_data JSON DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY provider_user (provider, provider_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
SQL;
    $pdo->exec($sql);
    echo "✓ oauth_providers table OK\n";

    // FEEDBACK (align with api/feedback.php)
    $sql = <<<SQL
CREATE TABLE IF NOT EXISTS feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  feedback TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
SQL;
    $pdo->exec($sql);
    echo "✓ feedback table OK\n";

    // Seed a demo user compatible with the API
    $name = 'Test User';
    $email = 'test@example.com';
    $hash = password_hash('password123', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT IGNORE INTO users (name, email, password, age) VALUES (?, ?, ?, 25)');
    $stmt->execute([$name, $email, $hash]);
    echo "✓ Sample user inserted (email: test@example.com / password: password123)\n";

    echo "\n🎉 Database setup completed successfully!\n";
    echo "Open: http://localhost/fitness_win11/index.php?page=login\n";

} catch (PDOException $e) {
    echo "✘ Database setup failed: " . $e->getMessage() . "\n";
    echo "Check config in config/config.php and ensure MySQL is running.\n";
    exit(1);
}
?>