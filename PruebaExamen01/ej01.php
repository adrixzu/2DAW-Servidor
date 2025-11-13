<?php
session_start();

define('CUENTAFICHERO', 'misaldo.txt');

// NO está definido el token
if (!isset($_SESSION['token'])) {
    header('Location: acceso.php?msg=Error+de+acceso 1');
    exit();
}

if ($_SESSION['token'] != $_POST['token']){
    $msg ="Error de acceso";
    header("Location: acceso.php?msg=" .urlencode($msg));
    exit();
}

$saldo = @file_get_contents(CUENTAFICHERO);

if ($_POST['Orden'] == "Ver saldo"){
    $msg ="Su saldo actual es ".number_format($saldo,2,',','.');
    header("Location: acceso.php?msg=".urlencode($msg));
    exit();
}

if (empty($_POST['importe']) || !is_numeric($_POST['importe']) || $_POST['importe'] < 0 ){
    $msg ="Importe Erroneo o importe menor a 0";
    header("Location: acceso.php?msg=" .urlencode($msg));
    exit();
}
$importe = $_POST['importe'];

if ($_POST['Orden'] == "Ingreso"){
    $salgo = $saldo + $importe;
    file_put_contents(CUENTAFICHERO,$saldo);
    $msg ="Operacion realizada";
    header("Location: acceso.php?msg=" .urlencode($msg));
}

if ($_POST['Orden'] == "Reintegro"){
    if ($importe <= $saldo){
        $salgo = $saldo - $importe;
        file_put_contents(CUENTAFICHERO,$saldo);
        $msg ="Operacion realizada";
    } else {
        $msg = "Operacion fallida";
    }
    header("Location: acceso.php?msg=" .urlencode($msg));
}