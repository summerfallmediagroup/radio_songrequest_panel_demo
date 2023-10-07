<?php
// Kapcsolódás az adatbázishoz
$dbconn = pg_connect("host=localhost dbname=yourdbname user=yourdbuser password=yourdbpassword")
    or die('Kapcsolódási hiba: ' . pg_last_error());

// POST adatok ellenőrzése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eloado = $_POST['eloado'];
    $cim = $_POST['cim'];
    $uzenet = $_POST['uzenet'];

    // SQL lekérdezés összeállítása és végrehajtása
    $query = "INSERT INTO requests (eloado, cim, uzenet) VALUES ('$eloado', '$cim', '$uzenet')";
    $result = pg_query($query) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

    // Adatbázis kapcsolat lezárása
    pg_close($dbconn);

    // Sikeres kérés esetén átirányítás az index.php-re
    header("Location: index.php");
    exit();
}
?>
