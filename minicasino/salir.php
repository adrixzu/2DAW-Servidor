<?php
session_start();

$final = isset($_SESSION['dinero']) ? $_SESSION['dinero'] : 0;
$visitas = isset($_COOKIE['visitas']) ? $_COOKIE['visitas'] : 1;

session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MiniCasino - Fin</title>
</head>
<body>
    <h1>Muchas gracias por jugar con nosotros.</h1>
    <p>Su resultado final es de <?php echo $final; ?> euros.</p>
    <p>Esta fue su visita número <?php echo $visitas; ?>.</p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
