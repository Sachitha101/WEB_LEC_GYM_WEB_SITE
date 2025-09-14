<?php
// Simple auth API using PDO
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';

function jsonResponse($success, $message, $data = null) {
    echo json_encode(['success' => $success, 'message' => $message, 'data' => $data]);
    exit;
}

// Handle signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'signup') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];

    // CSRF
    if (!isset($input['csrf_token']) || !validate_csrf_token($input['csrf_token'])) {
        jsonResponse(false, 'Invalid CSRF token');
    }

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

    // CSRF
    if (!isset($input['csrf_token']) || !validate_csrf_token($input['csrf_token'])) {
        jsonResponse(false, 'Invalid CSRF token');
    }

    $email = sanitizeInput($input['email'] ?? '');
    $password = $input['password'] ?? '';

    if (empty($email) || empty($password)) jsonResponse(false, 'Email and password required');

    $pdo = connectDB();
    if (!$pdo) jsonResponse(false, 'Database connection error');

    $stmt = $pdo->prepare('SELECT id, name, password FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        jsonResponse(true, 'Login successful', ['name' => $user['name']]);
    }
    jsonResponse(false, 'Invalid credentials');
}

// Handle logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'logout') {
    session_destroy();
    jsonResponse(true, 'Logged out');
}

// Provide CSRF token
if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'csrf') {
    echo json_encode(['csrf_token' => generate_csrf_token()]);
    exit;
}

http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Invalid endpoint']);
