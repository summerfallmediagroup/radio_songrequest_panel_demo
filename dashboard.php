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

// Betöltjük a zenei kéréseket
$query = "SELECT * FROM requests WHERE teljesitve = false OR teljesitve IS NULL";
$result = pg_query($query) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());
print_r(pg_fetch_assoc($result)); 
// Betöltjük a teljesített kéréseket
$completedQuery = "SELECT * FROM requests WHERE teljesitve = true";
$completedResult = pg_query($completedQuery) or die('Hiba a lekérdezés végrehajtásában: ' . pg_last_error());

// Oldal tartalma
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zenei Kérések - Admin Felület</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Zenei Kérések - Admin Felület</h2>

    <h3>Beküldött kérések</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Előadó</th>
            <th scope="col">Cím</th>
            <th scope="col">Üzenet</th>
            <th scope="col">Teljesítve</th>
            <th scope="col">Műveletek</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = pg_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['eloado'] ?></td>
                <td><?= $row['cim'] ?></td>
                <td><?= $row['uzenet'] ?></td>
                <td><?= $row['teljesitve'] ? 'Igen' : 'Nem' ?></td>
                <td>
                    <form action="mark_completed.php" method="post">
                        <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-success">Teljesítve</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Teljesített kérések</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Előadó</th>
            <th scope="col">Cím</th>
            <th scope="col">Üzenet</th>
            <th scope="col">Műveletek</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = pg_fetch_assoc($completedResult)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['eloado'] ?></td>
                <td><?= $row['cim'] ?></td>
                <td><?= $row['uzenet'] ?></td>
                <td>
                <form action="delete_request.php" method="post">
                        <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-warning">Törlés</button>
                </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="logout.php" class="btn btn-danger">Kijelentkezés</a>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>