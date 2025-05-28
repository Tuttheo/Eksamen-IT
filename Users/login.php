<?php
// Start PHP session to manage user sessions
session_start();

// Include the database connection file
require_once 'db_connect.php';

// Initialize an empty variable for storing error messages
$error_message = "";

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the login button was pressed
    if (isset($_POST['login'])) {
        // Sanitize and get username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare a SQL statement to select user data by username
        // Using prepared statements prevents SQL injection
        $stmt = $pdo->prepare("SELECT user_id, username, password FROM users WHERE username = :username");
        // Execute the statement with the provided username
        $stmt->execute([':username' => $username]);
        // Fetch the user data as an associative array
        $user = $stmt->fetch();

        // Check if a user was found AND if the provided password matches the hashed password in the database
        if ($user && password_verify($password, $user['password'])) {
            // If login is successful, set session variables for user ID and username
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            // Redirect the user to the index page
            header('Location: index.php');
            // Exit the script to prevent further code execution after redirection
            exit;
        } else {
            // If login fails (user not found or password incorrect), set an error message
            $error_message = "Feil brukernavn eller passord";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <!-- Set the character set to UTF-8 for proper display of Norwegian characters -->
    <meta charset="UTF-8">
    <!-- Set the viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set the title of the page displayed in the browser tab -->
    <title>Logg inn</title>
    <!-- Link to the external stylesheet for general site styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Start of internal CSS for specific styling of this page -->
    
</head>
<body>
    <!-- Site header -->
    <header>
        <h1>Velkommen tilbake</h1>
    </header>

    <!-- Main content area for the login form -->
    <main>
        <!-- Login form container -->
        <div class="login-container">
            <?php
            // Display error message if it exists
             if ($error_message): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <!-- Login form -->
            <form method="POST">
                <!-- Form group for username -->
                <div class="form-group">
                    <label for="username">Brukernavn</label>
                    <input type="text" id="username" name="username" required placeholder="Skriv inn brukernavn">
                </div>

                <!-- Form group for password -->
                <div class="form-group">
                    <label for="password">Passord</label>
                    <input type="password" id="password" name="password" required placeholder="Skriv inn passord">
                </div>

                <!-- Submit button for login -->
                <button type="submit" name="login" class="submit-btn">Logg inn</button>
            </form>

            <!-- Link to the registration page -->
            <div class="register-link">
                <p>Har du ikke en konto? <a href="register.php">Registrer deg her</a></p>
            </div>
        </div>
    </main>

    <!-- Site footer -->
    <footer>
        <!-- Copyright text -->
        <p>&copy; 2025 Sko Butikken. Alle rettigheter reservert.</p>
    </footer>
</body>
</html> 