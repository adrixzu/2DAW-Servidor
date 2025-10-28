<?php
session_start();

if (!isset($_SESSION['dinero'])) {
    echo "<p>No ha iniciado el juego. <a href='index.php'>Volver al inicio</a></p>";
    exit;
}

$visitas = isset($_COOKIE['visitas']) ? $_COOKIE['visitas'] : 1;
$dinero = $_SESSION['dinero'];
$mensaje = "";

if (isset($_POST['apostar'])) {
    $apuesta = intval($_POST['cantidad']);
    $tipo = $_POST['tipo'];

    if ($apuesta > $dinero || $apuesta <= 0) {
        $mensaje = "Error: no dispone de $apuesta euros disponibles. Dispone de $dinero para jugar.";
    } else {
        $numero = rand(1, 100);
        $resultado = ($numero % 2 == 0) ? "par" : "impar";

        if ($tipo == $resultado) {
            $dinero += $apuesta;
            $mensaje = "Ha ganado. Salió $resultado ($numero).";
        } else {
            $dinero -= $apuesta;
            $mensaje = "Ha perdido. Salió $resultado ($numero).";
        }

        $_SESSION['dinero'] = $dinero;
    }
}

if (isset($_POST['salir'])) {
    include_once("salir.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MiniCasino - Juego</title>
</head>
<body>
    <h1>EL MINICASINO</h1>
    <p>Visita número: <?php echo $visitas; ?></p>
    <p>Dinero disponible: <?php echo $dinero; ?> €</p>

    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>

    <?php if ($dinero > 0): ?>
        <form method="post">
            <label>Cantidad a apostar:</label><br>
            <input type="number" name="cantidad" min="1" required><br><br>

            <label>Tipo de apuesta:</label><br>
            <input type="radio" name="tipo" value="par" required> Par
            <input type="radio" name="tipo" value="impar" required> Impar<br><br>

            <input type="submit" name="apostar" value="Apostar cantidad">
            <input type="submit" name="salir" value="Abandonar el casino">
        </form>
    <?php else: ?>
        <p>Se ha quedado sin dinero.</p>
        <?php include_once("salir.php"); ?>
    <?php endif; ?>
</body>
</html>
