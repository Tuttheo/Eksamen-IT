<?php
// Include the database connection file
require_once 'db_connect.php';
// Start the PHP session
session_start();

// Sjekk om brukeren er logget inn
if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect to login page
    header('Location: login.php');
    // Exit the script
    exit;
}