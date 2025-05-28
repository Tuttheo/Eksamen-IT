<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    
    exit;
}

include 'header.php';
?>
</body>
</html>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sko Butikk</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <main class="shoe-grid">
        <div class="shoe-card">
            <img src="Bilder/Blue.png" alt="Air Jordan 1 University Blue">
            <h3>Jordan 1 Retro High OG</h3>
            <p>University Blue</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=1'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 3 499,-</span>
            </div>
        </div>

        <div class="shoe-card">
            <img src="Bilder/Mocha.png" alt="Air Jordan 1 Shadow 2.0">
            <h3>Jordan 1 Retro High</h3>
            <p>Dark Mocha</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=2'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 4 299,-</span>
            </div>
        </div>

        <div class="shoe-card">
            <img src="Bilder/Purple.png" alt="Air Jordan 1 Court Purple">
            <h3>Jordan 1 Retro High</h3>
            <p>Court Purple</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=3'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 2 899,-</span>
            </div>
        </div>

        <div class="shoe-card">
            <img src="Bilder/Screenshot 2025-05-26 at 11.39.35.png" alt="Sko 4">
            <h3>Jordan 1 Retro Low OG SP</h3>
            <p>Fragment x Travis Scott</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=4'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 8299,-</span>
            </div>
        </div>

        <div class="shoe-card">
            <img src="Bilder/Screenshot 2025-05-26 at 11.40.12.png" alt="Sko 5">
            <h3>Jordan 1 Low SE</h3>
            <p>Black Toe (2025)</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=5'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 1 099,-</span>
            </div>
        </div>

        <div class="shoe-card">
            <img src="Bilder/Screenshot 2025-05-26 at 11.41.31.png" alt="Sko 6">
            <h3>Jordan 1 Retro Low OG</h3>
            <p>Zion Williamson Voodoo</p>
            <div class="button-group">
                <button onclick="location.href='#'" class="read-more">Les mer</button>
                <button onclick="location.href='order.php?shoe=6'" class="buy">Kjøp</button>
                <span class="shoe-price">kr 5 599,-</span>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Sko Butikken. Alle rettigheter reservert.</p>
    </footer>
</body>
</html>