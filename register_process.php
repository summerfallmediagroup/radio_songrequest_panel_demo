<?php
// Kapcsolódás az adatbázishoz
$dbconn = pg_connect("host=localhost dbname=yourdbname user=yourdbuser password=yourdbpassword")
    or die('Kapcsolódási hiba: ' . pg_last_error());

// POST adatok ellenőrzése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ellenőrzés, hogy a felhasználónév még nem foglalt-e
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = pg_query($check_query) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());
    if (pg_num_rows($check_result) > 0) {
        // A felhasználónév már foglalt
        echo "A felhasználónév már foglalt. Kérlek, válassz másikat.";
        exit();
    }

    // Jelszó hashelése
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL lekérdezés összeállítása és végrehajtása
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    $result = pg_query($query) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

    // Adatbázis kapcsolat lezárása
    pg_close($dbconn);

    // Sikeres regisztráció esetén átirányítás az index.php-re
    header("Location: index.php");
    exit();
}
?>