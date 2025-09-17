<?php
// Test script to check feedback pages
require_once __DIR__ . '/config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Set test session
$_SESSION['user_id'] = 1;
$_SESSION['user_name'] = 'Test User';
$_SESSION['user_email'] = 'test@example.com';

echo "Test session created.\n";
echo "Visit: http://localhost/fitness_win11/index.php?page=feedback_feature\n";
echo "Or: http://localhost/fitness_win11/index.php?page=feedback_issue\n";
echo "Or: http://localhost/fitness_win11/index.php?page=feedback_support\n";
?>