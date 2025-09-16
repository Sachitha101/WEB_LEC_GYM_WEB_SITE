

<?php
// Initialize session and load configuration
require_once __DIR__ . '/../config/config.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
