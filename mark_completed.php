<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Kapcsolódás az adatbázishoz
$dbconn = pg_connect("host=localhost dbname=yourdbname user=yourdbuser password=yourdbpassword")
    or die('Kapcsolódási hiba: ' . pg_last_error());

// POST adatok ellenőrzése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['request_id'];

    // SQL lekérdezés összeállítása és végrehajtása
    $updateQuery = "UPDATE requests SET teljesitve = TRUE WHERE id = $requestId";
    $result = pg_query($updateQuery) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

    // Az adatbázis kapcsolat lezárása
    pg_close($dbconn);

    // Átirányítás az admin felületre
    header("Location: dashboard.php");
    exit();
}
?>