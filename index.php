<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zenei Kérések</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Zenei Kérések</h2>

    <!-- Regisztráció és bejelentkezés linkjei -->
    <p>
        <a href="registration.php">Regisztráció</a> |
        <a href="login.php">Bejelentkezés</a>
    </p>

    <!-- Zenei kérések beküldéséhez űrlap -->
    <form action="process.php" method="post">
        <div class="mb-3">
            <label for="eloado" class="form-label">Előadó neve</label>
            <input type="text" class="form-control" id="eloado" name="eloado" required>
        </div>
        <div class="mb-3">
            <label for="cim" class="form-label">Zene címe</label>
            <input type="text" class="form-control" id="cim" name="cim" required>
        </div>
        <div class="mb-3">
            <label for="uzenet" class="form-label">Üzenet</label>
            <textarea class="form-control" id="uzenet" name="uzenet" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kérés elküldése</button>
    </form>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>