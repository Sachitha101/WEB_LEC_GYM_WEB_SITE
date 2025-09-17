-- Shared hosting friendly SQL (no CREATE DATABASE / no USE)
-- Instructions:
-- 1) In phpMyAdmin, first click your existing database (e.g., f0_39961734_fitness_db) on the left.
-- 2) Then go to Import and import this file. Tables will be created inside the selected DB.
-- 3) Make sure config/config.php DB_NAME matches that database.

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(191) NOT NULL,
  email VARCHAR(191) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('user') DEFAULT 'user',
  age INT DEFAULT 0,
  gender VARCHAR(32) DEFAULT NULL,
  education JSON DEFAULT NULL,
  country VARCHAR(128) DEFAULT NULL,
  avatar VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ensure 'role' column exists for existing installations (portable across MySQL versions)
-- Guarded dynamic statement avoids errors on hosts without ADD COLUMN IF NOT EXISTS
SET @has_role := (
  SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'users' AND COLUMN_NAME = 'role'
);
SET @ddl := IF(@has_role = 0,
  'ALTER TABLE users ADD COLUMN role ENUM("user") DEFAULT "user" AFTER password',
  'SELECT 1'
);
PREPARE stmt FROM @ddl; EXECUTE stmt; DEALLOCATE PREPARE stmt;

-- Convert any existing admin users to regular users
UPDATE users SET role = 'user' WHERE role = 'admin';

-- Table to map OAuth providers to local users
CREATE TABLE IF NOT EXISTS oauth_providers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  provider VARCHAR(64) NOT NULL,
  provider_id VARCHAR(191) NOT NULL,
  provider_data JSON DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY provider_user (provider, provider_id),
  CONSTRAINT fk_oauth_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- FEEDBACK & TICKETS (revamped)
-- Stores feature requests, general feedback, support tickets, and issue reports.
CREATE TABLE IF NOT EXISTS feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  category ENUM('feature','general','support','issue') NOT NULL,
  subject VARCHAR(191) NULL,
  description LONGTEXT NOT NULL,
  priority ENUM('low','medium','high','urgent','critical') NULL,
  status ENUM('open','in_progress','resolved','closed') NOT NULL DEFAULT 'open',
  assigned_to VARCHAR(191) NULL,
  attachment_path VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX ix_user (user_id),
  INDEX ix_category_status (category, status),
  CONSTRAINT fk_feedback_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- PRODUCTS
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT NULL,
  price DECIMAL(10,2) NOT NULL,
  category VARCHAR(50) NULL,
  image_path VARCHAR(255) NULL,
  stock_quantity INT DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ORDERS
CREATE TABLE IF NOT EXISTS orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  order_number VARCHAR(50) NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  status ENUM('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  shipping_address LONGTEXT NULL,
  billing_address LONGTEXT NULL,
  payment_method VARCHAR(50) NULL,
  payment_status ENUM('pending','paid','failed','refunded') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_order_number (order_number),
  CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ORDER ITEMS
CREATE TABLE IF NOT EXISTS order_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  CONSTRAINT fk_items_product FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- CART ITEMS (per-user, optional server-side persistence)
CREATE TABLE IF NOT EXISTS cart_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  product_id INT NULL,
  product_name VARCHAR(191) NOT NULL,
  category VARCHAR(50) NULL,
  price DECIMAL(10,2) NOT NULL,
  quantity INT NOT NULL DEFAULT 1,
  size VARCHAR(32) NULL,
  color VARCHAR(32) NULL,
  added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY ix_user (user_id),
  CONSTRAINT fk_cart_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- USER SESSIONS
CREATE TABLE IF NOT EXISTS user_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  session_token VARCHAR(255) NOT NULL,
  ip_address VARCHAR(45) NULL,
  user_agent TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  expires_at TIMESTAMP NULL,
  is_active TINYINT(1) DEFAULT 1,
  UNIQUE KEY uq_session_token (session_token),
  KEY ix_expires (expires_at),
  CONSTRAINT fk_sessions_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- WORKOUT PLANS
CREATE TABLE IF NOT EXISTS workout_plans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  plan_name VARCHAR(100) NOT NULL,
  description TEXT NULL,
  difficulty ENUM('beginner','intermediate','advanced') DEFAULT 'beginner',
  duration_weeks INT DEFAULT 4,
  goals LONGTEXT NULL,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_plans_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- WORKOUT SESSIONS
CREATE TABLE IF NOT EXISTS workout_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  plan_id INT NULL,
  session_date DATE NOT NULL,
  duration_minutes INT NULL,
  exercises_completed LONGTEXT NULL,
  notes TEXT NULL,
  rating TINYINT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_ws_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_ws_plan FOREIGN KEY (plan_id) REFERENCES workout_plans(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- USER MEMBERSHIPS (tracks Basic/Premium/Elite tier per user)
CREATE TABLE IF NOT EXISTS user_memberships (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  tier ENUM('basic','premium','elite') NOT NULL DEFAULT 'basic',
  started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_user (user_id),
  CONSTRAINT fk_um_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- INSERT ADMIN USER (for hosting deployment)
-- Username: admin
-- Email: admin@fitnesswin11.com
-- Password: AdminPass123!
-- Role: admin
-- REMOVED: Admin role has been eliminated from the system

-- Migration notes (shared hosting):
-- - Import this file into the target database selected in phpMyAdmin (no CREATE DATABASE used).
-- - This script is idempotent: it uses IF NOT EXISTS and guarded DDL for minimal conflicts.
-- - Feedback priority includes 'urgent' to match UI; 'critical' is accepted as well.
-- - If upgrading an older DB with admin roles, the update below will normalize to 'user'.
