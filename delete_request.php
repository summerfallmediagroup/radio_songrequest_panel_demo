<?php
session_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
    $deleteQuery = "DELETE * FROM requests WHERE id = $requestId";
    $result = pg_query($deleteQuery) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

    // Az adatbázis kapcsolat lezárása
    pg_close($dbconn);

    // Átirányítás az admin felületre
    header("Location: dashboard.php");
    exit();
}
?>