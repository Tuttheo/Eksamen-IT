<?php
// Start PHP session to be able to access and destroy the session
session_start();

// Destroy all data registered to the session
session_destroy();

// Redirect the user to the index page after logging out
header('Location: index.php');

// Exit the script to ensure redirection happens immediately
exit;
?> 