<?php
session_start();

// Kapcsolódás az adatbázishoz
$dbconn = pg_connect("host=localhost dbname=yourdbname user=yourdbuser password=yourdbpassword")
    or die('Kapcsolódási hiba: ' . pg_last_error());

// POST adatok ellenőrzése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL lekérdezés összeállítása és végrehajtása
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = pg_query($query) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

    // Ellenőrizzük, hogy van-e találat
    if ($row = pg_fetch_assoc($result)) {
        // Ellenőrizzük a jelszót
        if (password_verify($password, $row['password'])) {
            // Sikeres bejelentkezés
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            // Rossz jelszó
            echo "Hibás jelszó. Kérlek, próbáld újra.";
            exit();
        }
    } else {
        // Felhasználó nem található
        echo "Hibás felhasználónév. Kérlek, próbáld újra.";
        exit();
    }
}
?>