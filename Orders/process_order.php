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




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Hent data fra skjemaet og sanitiser input (selv om PDO parameters hindrer SQL Injection, god praksis)
        $shoe_id = $_POST['shoe_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
        // Set the order date to the current date and time
        $order_date = date('Y-m-d H:i:s');
        // Get the logged-in user's ID from the session
        $user_id = $_SESSION['user_id'];

        // Hent skoens navn fra databasen for bruk i e-post bekreftelse
        $stmt = $pdo->prepare("SELECT name FROM shoes WHERE id = :shoe_id");
        $stmt->execute([':shoe_id' => $shoe_id]);
        $shoe = $stmt->fetch();
        // Set shoe name, default to 'Ukjent sko' if not found
        $shoe_name = $shoe ? $shoe['name'] : 'Ukjent sko';

        // Legg inn bestillingen i databasen i 'orders' tabellen
        $stmt = $pdo->prepare("INSERT INTO orders (shoe_id, user_id, customer_name, email, phone, address, postal_code, city, order_date) 
                              VALUES (:shoe_id, :user_id, :name, :email, :phone, :address, :postal_code, :city, :order_date)");
        
        // Execute the insert statement with the collected order data
        $stmt->execute([
            ':shoe_id' => $shoe_id,
            ':user_id' => $user_id,
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':address' => $address,
            ':postal_code' => $postal_code,
            ':city' => $city,
            ':order_date' => $order_date
        ]);

        // Send enkel e-post bekreftelse til kunden (Merk: mail() krever konfigurasjon av en mailserver)
        $to = $email;
        $subject = "Bekreftelse på din bestilling";
        $message = "Hei $name,\n\n";
        $message .= "Takk for din bestilling av $shoe_name.\n";
        $message .= "Vi vil kontakte deg når bestillingen er klar.\n\n";
        $message .= "Med vennlig hilsen\nSko Butikken";
        
        mail($to, $subject, $message);

        // Redirect til bekreftelsessiden etter vellykket bestilling
        header('Location: order_confirmation.php');
        exit;

    } catch(PDOException $e) {
        // Hvis noe går galt med databaseoperasjonen, redirect tilbake til bestillingssiden med feilmelding
        header('Location: order.php?error=' . urlencode('Kunne ikke prosessere bestillingen. Vennligst prøv igjen.'));
        exit;
    }
} else {
    // Hvis noen prøver å aksessere denne siden direkte (ikke via POST), redirect til index.php
    header('Location: index.php');
    exit;
}
?> 