<?php
// Start PHP session to access session variables like user_id and username
session_start();
?>
<header>
    <!-- Site main title -->
    <h1>Velkommen til Sko Butikken</h1>
    <!-- Container for user-specific menu items -->
    <div class="user-menu">
        <!-- Display welcome message with the logged-in username -->
        <span style="color: white;">Velkommen, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <!-- Logout link -->
        <a href="logout.php" style="margin-left: 10px;">Logg ut</a>
    </div>
</header>

<!-- Internal CSS for header and user menu styling -->
<style>
    /* Style for the user menu container */
    .user-menu {
        /* Position the menu absolutely relative to the nearest positioned ancestor (or body) */
        position: absolute;
        /* Place the menu 1rem from the top edge */
        top: 1rem;
        /* Place the menu 1rem from the right edge */
        right: 1rem;
    }
    /* Style for links within the user menu */
    .user-menu a {
        /* Set text color to white */
        color: white;
        /* Remove underline */
        text-decoration: none;
        /* Add padding around the link text */
        padding: 0.5rem 1rem;
        /* Set background color */
        background-color: #4CAF50;
        /* Apply border radius for rounded corners */
        border-radius: 4px;
    }
    /* Style for links within the user menu on hover */
    .user-menu a:hover {
        /* Change background color on hover */
        background-color: #45a049;
    }
</style> 