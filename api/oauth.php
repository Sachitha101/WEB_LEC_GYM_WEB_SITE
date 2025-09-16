<?php
// oauth.php — handle OAuth provider integrations
/*
Project Roles (Vote to assign):
1. API Integration Specialist
2. Authentication & Security Lead
3. Backend Developer (PHP)
4. DevOps & Deployment

This file handles OAuth integrations; owner should be API Integration + Auth Lead.
Voting note: OAuth changes need security review and testing before deployment.
*/
require_once __DIR__ . '/../config/config.php';
session_start();
header('Content-Type: application/json');

// Demo OAuth handler — in production, integrate with real OAuth providers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true) ?? [];
    $provider = sanitizeInput($input['provider'] ?? '');
    $code = sanitizeInput($input['code'] ?? '');

    if (empty($provider) || empty($code)) {
        echo json_encode(['success' => false, 'message' => 'Provider and authorization code required']);
        exit;
    }

    // Demo: simulate OAuth token exchange
    // In production, exchange code for access token with provider's API
    $mockTokenResponse = [
        'access_token' => 'mock_access_token_' . time(),
        'token_type' => 'Bearer',
        'expires_in' => 3600,
        'user_info' => [
            'id' => 'mock_user_' . rand(1000, 9999),
            'email' => 'user' . rand(1000, 9999) . '@' . $provider . '.com',
            'name' => 'Mock User from ' . ucfirst($provider)
        ]
    ];

    // Use the mock user info to create/link account
    $userInfo = $mockTokenResponse['user_info'];
    $pdo = connectDB();

    if ($pdo) {
        // Check if user already exists with this provider
        $stmt = $pdo->prepare('SELECT u.id, u.name, u.email FROM oauth_providers op JOIN users u ON op.user_id = u.id WHERE op.provider = ? AND op.provider_id = ?');
        $stmt->execute([$provider, $userInfo['id']]);
        $existingUser = $stmt->fetch();

        if ($existingUser) {
            // User exists, log them in
            $_SESSION['user_id'] = $existingUser['id'];
            $_SESSION['user_name'] = $existingUser['name'];
            $_SESSION['user_email'] = $existingUser['email'];
            echo json_encode(['success' => true, 'message' => 'Logged in with ' . ucfirst($provider), 'user' => ['name' => $existingUser['name']]]);
            exit;
        }

        // Check if email already exists
        $stmt = $pdo->prepare('SELECT id, name FROM users WHERE email = ?');
        $stmt->execute([$userInfo['email']]);
        $existingEmailUser = $stmt->fetch();

        if ($existingEmailUser) {
            // Link existing account with OAuth provider
            $stmt = $pdo->prepare('INSERT INTO oauth_providers (user_id, provider, provider_id, provider_data) VALUES (?, ?, ?, ?)');
            $stmt->execute([$existingEmailUser['id'], $provider, $userInfo['id'], json_encode($mockTokenResponse)]);
            $_SESSION['user_id'] = $existingEmailUser['id'];
            $_SESSION['user_name'] = $existingEmailUser['name'];
            $_SESSION['user_email'] = $userInfo['email'];
            echo json_encode(['success' => true, 'message' => 'Account linked with ' . ucfirst($provider), 'user' => ['name' => $existingEmailUser['name']]]);
            exit;
        }

        // Create new user
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())');
        $randomPass = bin2hex(random_bytes(16));
        $hashedPass = password_hash($randomPass, PASSWORD_DEFAULT);
        $stmt->execute([$userInfo['name'], $userInfo['email'], $hashedPass]);
        $newUserId = $pdo->lastInsertId();

        // Link OAuth provider
        $stmt = $pdo->prepare('INSERT INTO oauth_providers (user_id, provider, provider_id, provider_data) VALUES (?, ?, ?, ?)');
        $stmt->execute([$newUserId, $provider, $userInfo['id'], json_encode($mockTokenResponse)]);

        // Log in new user
        $_SESSION['user_id'] = $newUserId;
        $_SESSION['user_name'] = $userInfo['name'];
        $_SESSION['user_email'] = $userInfo['email'];
        echo json_encode(['success' => true, 'message' => 'Account created with ' . ucfirst($provider), 'user' => ['name' => $userInfo['name']]]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request method']);