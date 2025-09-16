<?php
/*
Project Roles (Vote to assign):
1. Authentication & Security Lead
2. Backend Developer (PHP)
3. API Integration Specialist
4. Testing & Quality Assurance
5. Documentation & Support

This file is critical for auth flows; owner should be Auth Lead + Backend Developer.
Voting note: require 2 approvals (Auth Lead + QA) before merging changes here.
*/
// Simple auth API using PDO
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

function jsonResponse($success, $message, $data = null) {
    echo json_encode(['success' => $success, 'message' => $message, 'data' => $data]);
    exit;
}

// Handle signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'signup') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];

    // (CSRF checks removed for demo/basic PHP simplicity)

    $name = sanitizeInput($input['name'] ?? '');
    $email = sanitizeInput($input['email'] ?? '');
    $password = $input['password'] ?? '';
    $age = (int)($input['age'] ?? 0);
    $gender = sanitizeInput($input['gender'] ?? null);
    $education = $input['education'] ?? null; // expect array or null
    $country = sanitizeInput($input['country'] ?? null);

    if (empty($name) || empty($email) || empty($password)) {
        jsonResponse(false, 'All fields are required');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(false, 'Invalid email');
    }
    if (strlen($password) < 8) {
        jsonResponse(false, 'Password must be at least 8 characters');
    }
    if ($age <= 15) {
        jsonResponse(false, 'You must be older than 15');
    }

    $pdo = connectDB();
    if (!$pdo) jsonResponse(false, 'Database connection error');

    // Check existing
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) jsonResponse(false, 'Email already registered');

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    // store education as JSON if provided
    $educationJson = null;
    if (is_array($education)) {
        $educationJson = json_encode(array_values($education));
    } elseif (!empty($education)) {
        // single value
        $educationJson = json_encode([$education]);
    }

    $stmt = $pdo->prepare('INSERT INTO users (name, email, password, age, gender, education, country, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())');
    $ok = $stmt->execute([$name, $email, $hashed, $age, $gender, $educationJson, $country]);
    if ($ok) {
        jsonResponse(true, 'Registration successful');
    }
    jsonResponse(false, 'Registration failed');
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'login') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];

    // (CSRF checks removed for demo/basic PHP simplicity)

    $email = sanitizeInput($input['email'] ?? '');
    $password = $input['password'] ?? '';

        if (empty($email) || empty($password)) jsonResponse(false, 'Email and password required');

        $pdo = connectDB();
        if (!$pdo) jsonResponse(false, 'Database connection error');

        // Lookup user by email
        $stmt = $pdo->prepare('SELECT id, name, password FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if (!$user) {
            jsonResponse(false, 'Invalid credentials');
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            jsonResponse(false, 'Invalid credentials');
        }

        // Successful login — set session using DB values
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $email;
        jsonResponse(true, 'Login successful', ['name' => $user['name']]);
}

// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'logout') {
    session_destroy();
    jsonResponse(true, 'Logged out');
}

// Handle OAuth-style provider sign-in (demo)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'oauth') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
    $provider = sanitizeInput($input['provider'] ?? '');
    $provider_id = sanitizeInput($input['provider_id'] ?? '');
    $email = sanitizeInput($input['email'] ?? '');
    $name = sanitizeInput($input['name'] ?? ($email ? strstr($email, '@', true) : ''));

    if (empty($provider) || empty($provider_id) || empty($email)) {
        jsonResponse(false, 'Provider, provider_id and email required');
    }

    $pdo = connectDB();
    if (!$pdo) jsonResponse(false, 'Database connection error');

    // Try to find existing mapping in oauth_providers
    $stmt = $pdo->prepare('SELECT user_id FROM oauth_providers WHERE provider = ? AND provider_id = ? LIMIT 1');
    $stmt->execute([$provider, $provider_id]);
    $map = $stmt->fetch();
    if ($map) {
        // Found mapping, load user
        $stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$map['user_id']]);
        $user = $stmt->fetch();
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            jsonResponse(true, 'Login successful (provider)', ['name' => $user['name']]);
        }
    }

    // No mapping found — check if a user exists with this email
    $stmt = $pdo->prepare('SELECT id, name FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Create a new user
        $randomPass = bin2hex(random_bytes(12));
        $hashed = password_hash($randomPass, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())');
        $ok = $stmt->execute([$name ?: $provider . '-user', $email, $hashed]);
        if (!$ok) jsonResponse(false, 'Could not create account');
        $userId = $pdo->lastInsertId();
    } else {
        $userId = $user['id'];
    }

    // Insert mapping into oauth_providers
    $providerData = json_encode(['raw' => $input]);
    $stmt = $pdo->prepare('INSERT INTO oauth_providers (user_id, provider, provider_id, provider_data, created_at) VALUES (?, ?, ?, ?, NOW())');
    $ok = $stmt->execute([$userId, $provider, $provider_id, $providerData]);
    if ($ok) {
        // Sign in
        $stmt = $pdo->prepare('SELECT id, name, email FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $u = $stmt->fetch();
        $_SESSION['user_id'] = $u['id'];
        $_SESSION['user_name'] = $u['name'];
        $_SESSION['user_email'] = $u['email'];
        jsonResponse(true, 'Account linked and signed in (provider)', ['name' => $u['name']]);
    }
    jsonResponse(false, 'Failed to link provider');
}

// No CSRF endpoint in simplified demo API

http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Invalid endpoint']);