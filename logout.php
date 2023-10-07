<?php
session_start();

// Munkamenet lezárása
session_unset();
session_destroy();

// Visszairányítás a bejelentkező oldalra
header("Location: login.php");
exit();
?>