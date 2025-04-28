<?php
session_start();
require_once 'router.php';

// Define or include the $routes variable
$routes = include __DIR__ . '/routes.php'; // Ensure 'routes.php' returns an array of routes



// Check if user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    // Redirect to login page if not already on it
    if ($_SERVER['REQUEST_URI'] !== '/login') {
        header('Location: /login');
        exit;
    }
}

// Handle dynamic URLs
handleRequest($routes);
