<?php
session_start();
require_once 'router.php';

// Check if user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: /login.php');
    exit;
}

// Handle dynamic URLs
handleRequest();
