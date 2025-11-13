<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    $_SESSION['nombre'] = "";
    $_SESSION['lenguajes'] =[];
}

if (isset($_POST['nombre'])) {
    $_SESSION['nombre'] = $_POST['nombre'];
}

if (isset($_POST['lenguajes'])) {
    $_SESSION['lenguajes'] = $_POST['lenguajes'];
}

$nombre = $_SESSION['nombre'];

//function estalenguaje($lenguaje) :bool{
   // for ($_SESSION['lenguajes'] as $leng){
   //        
  //  }
//}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Selección de personal</title>
</head>

<body>
    <h2> Datos de candidato: Paso 2º </h2>
    <form action="seleccion.php" method="POST">
        <fieldset>
            <legend>Datos Profesionales </legend>
            Nombre : <input type="text" name="nombre" value="<?php $nombre ?>"></br>
            Lenguajes de programación:<br>
            <select name="lenguajes[]" multiple="multiple" size=6>
                <option value="Java" <? estalenguaje("Java")?"selected=''selected'" :"" ?>>Java</option>
                <option value="Javascripts">Javascripts</option>
                <option value="Php" selected="selected">Php</option>
                <option value="Python">Python</option>
                <option value="Perl">Perl</option>
                <option value="C#">C#</option>
            </select><br>
            <input type="submit" value="Enviar">
        </fieldset>