<?php
session_start();
require_once 'db_connect.php';

$error_message = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Sjekk om brukernavnet allerede eksisterer
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    if ($stmt->fetch()) {
        $error_message = "Brukernavnet er allerede i bruk";
    } else {
       // Hash passordet
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Legg inn den nye brukeren
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        try {
            $stmt->execute([
                ':username' => $username,
                ':password' => $hashed_password,
                ':email' => $email
            ]);
            $success_message = "Registrering vellykket! Du kan nå logge inn.";
        } catch(PDOException $e) {
            $error_message = "Kunne ikke registrere bruker. Vennligvis prøv igjen.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer deg</title>
    <link rel="stylesheet" href="style.css">
    
    </style>
</head>
<body>
    <header>
        <h1>Opprett ny bruker</h1>
    </header>

    <main>
        <div class="register-container">
            <?php if ($error_message): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="success-message">
                    <?php echo htmlspecialchars($success_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Brukernavn</label>
                    <input type="text" id="username" name="username" required placeholder="Velg et brukernavn">
                </div>

                <div class="form-group">
                    <label for="email">E-post</label>
                    <input type="email" id="email" name="email" required placeholder="Skriv inn din e-post">
                </div>

                <div class="form-group">
                    <label for="password">Passord</label>
                    <input type="password" id="password" name="password" required placeholder="Velg et passord">
                </div>

                <button type="submit" class="submit-btn">Registrer deg</button>
            </form>

            <div class="login-link">
                <p>Har du allerede en konto? <a href="login.php">Logg inn her</a></p>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Sko Butikken. Alle rettigheter reservert.</p>
    </footer>
</body>
</html> 