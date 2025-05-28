<?php
// Parametre for databasekobling
$host = 'localhost'; // Databasevert (vanligvis localhost)
$dbname = 'Sko'; // Databasenavn
$username = 'theodor'; // Database brukernavn
$password = 'Theodor220906'; // Database passord

// Forsøk å etablere en databasekobling ved bruk av PDO (PHP Data Objects)
try {
    // Opprett en ny PDO instans
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Sett PDO feilmodus til unntak (exception) for bedre feilhåndtering
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Hvis tilkoblingen feiler, stopp skriptet og vis feilmelding
    die("Kunne ikke koble til databasen: " . $e->getMessage());
}
?> 