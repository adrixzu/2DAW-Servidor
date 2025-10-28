<?php
session_start();

if (!isset($_COOKIE['visitas'])) {
    $visitas = 1;
} else {
    $visitas = $_COOKIE['visitas'] + 1;
}
setcookie('visitas', $visitas, time() + (30 * 24 * 60 * 60)); // 30 días

if (isset($_SESSION['dinero'])) {
    include_once("juego.php");
    exit;
}

if (isset($_POST['dinero_inicial'])) {
    $_SESSION['dinero'] = intval($_POST['dinero_inicial']);
    include_once("juego.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido al Casino</title>
</head>
<body>
    <h1>BIENVENIDO AL CASINO</h1>
    <p>Esta es su visita número: <?php echo $visitas; ?></p>

    <form method="post">
        <label>Introduzca el dinero con el que va a jugar:</label><br>
        <input type="number" name="dinero_inicial" min="1" required><br><br>
        <input type="submit" value="Entrar al Casino">
    </form>
</body>
</html>
