<?php
// Include the database connection file
require_once 'db_connect.php';
// Start the PHP session
session_start();

// Get the shoe ID from the URL parameter 'shoe', default to null if not set
$shoe_id = isset($_GET['shoe']) ? $_GET['shoe'] : null;
// Initialize variables for shoe name and error message
$shoe_name = "";
$error_message = "";

// Hent skoens navn fra databasen hvis shoe_id er satt
if ($shoe_id) {
    try {
        // Prepare a SQL statement to select the shoe name by ID
        // Using prepared statements prevents SQL injection
        $stmt = $pdo->prepare("SELECT name FROM shoes WHERE id = :shoe_id");
        // Execute the statement with the provided shoe ID
        $stmt->execute([':shoe_id' => $shoe_id]);
        // Fetch the shoe data as an associative array
        $shoe = $stmt->fetch();
        // Check if a shoe was found
        if ($shoe) {
            // Set the shoe name variable
            $shoe_name = $shoe['name'];
        } else {
            // Set an error message if the shoe was not found
            $error_message = "Skoen ble ikke funnet";
        }
    } catch(PDOException $e) {
        // Catch database errors and set an error message
        $error_message = "Kunne ikke hente skoinformasjon";
    }
}

// Sjekk om det er en feilmelding i URL parameteren 'error'
if (isset($_GET['error'])) {
    // Sanitize and set the error message from the URL
    $error_message = htmlspecialchars($_GET['error']);
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
    <title>Bestill Sko</title>
    <!-- Link to the external stylesheet for general site styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Start of internal CSS for specific styling of this page -->
   
</head>
<body>
    <!-- Site header -->
    <header>
        <h1>Bestill Sko</h1>
        <?php
        // Display the shoe name if it exists
         if ($shoe_name): ?>
            <h2><?php echo htmlspecialchars($shoe_name); ?></h2>
        <?php endif; ?>
    </header>

    <!-- Main content area for the order form -->
    <main>
        <!-- Order form -->
        <form class="order-form" action="process_order.php" method="POST">
            <?php
            // Display error message if it exists
             if ($error_message): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <!-- Hidden input field for shoe ID -->
            <input type="hidden" name="shoe_id" value="<?php echo htmlspecialchars($shoe_id); ?>">
            
            <!-- Form group for Full Name -->
            <div class="form-group">
                <label for="name">Fullt navn</label>
                <input type="text" id="name" name="name" required placeholder="Skriv inn fullt navn">
            </div>

            <!-- Form group for Email -->
            <div class="form-group">
                <label for="email">E-post</label>
                <input type="email" id="email" name="email" required placeholder="Skriv inn e-postadresse">
            </div>

            <!-- Form group for Phone -->
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="tel" id="phone" name="phone" required placeholder="Skriv inn telefonnummer">
            </div>

            <!-- Form group for Address -->
            <div class="form-group">
                <label for="address">Adresse</label>
                <textarea id="address" name="address" rows="3" required placeholder="Skriv inn gateadresse"></textarea>
            </div>

            <!-- Form group for Postal Code -->
            <div class="form-group">
                <label for="postal_code">Postnummer</label>
                <input type="text" id="postal_code" name="postal_code" required pattern="\d{4}" title="Bruk 4 siffer" placeholder="F.eks. 0150">
            </div>

            <!-- Form group for City -->
            <div class="form-group">
                <label for="city">Poststed</label>
                <input type="text" id="city" name="city" required placeholder="Skriv inn poststed">
            </div>

            <!-- Submit button -->
            <button type="submit" class="submit-btn">Fullfør bestilling</button>
        </form>
    </main>

    <!-- Site footer -->
    <footer>
        <!-- Copyright text -->
        <p>&copy; 2025 Sko Butikken. Alle rettigheter reservert.</p>
    </footer>
</body>
</html> 