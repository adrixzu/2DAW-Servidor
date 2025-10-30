<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cartón de Bingo PHP</title>
    <style>
        table {
            font-family: arial;
            font-size: 35px;
            font-weight: bold;
            color: rgb(0, 0, 120);
            border: 5px double rgb(0, 0, 120);
            border-collapse: collapse;
        }
        #rellena {
            text-align: center;
            width: 50px;
            height: 80px;
            border: 2px solid rgb(120, 120, 180);
            background-color: rgb(230, 230, 255);
        }
        #numerito {
            font-size: 10px;
            text-align: left;
            margin-top: -14px;
            margin-bottom: 14px;
        }
        #vacia {
            text-align: center;
            width: 50px;
            height: 80px;
            border: 2px solid rgb(120, 120, 180);
            background-color: rgb(170, 170, 205);
        }
    </style>
</head>
<body>

<?php
$carton = array();
for ($i=0; $i<3; $i++) {
    for ($j=0; $j<9; $j++) {
        $carton[$i][$j] = 0;
    }
}

$rangos = array(
    array(1,9), array(10,19), array(20,29), array(30,39),
    array(40,49), array(50,59), array(60,69), array(70,79), array(80,90)
);
$una = array();
while (count($una) < 3) {
    $n = rand(0,8);
    if (!in_array($n, $una)) $una[] = $n;
}

for ($c=0; $c<9; $c++) {
    $min = $rangos[$c][0];
    $max = $rangos[$c][1];
    $cantidad = in_array($c, $una) ? 1 : 2;

    $nums = range($min, $max);
    shuffle($nums);

    $elegidos = array_slice($nums, 0, $cantidad);
    sort($elegidos);

    if ($cantidad == 1) {
        $fila = rand(0,2);
        $carton[$fila][$c] = $elegidos[0];
    } else {
        $fila1 = rand(0,2);
        do { $fila2 = rand(0,2); } while ($fila2 == $fila1);
        $carton[$fila1][$c] = $elegidos[0];
        $carton[$fila2][$c] = $elegidos[1];
    }
}

for ($f=0; $f<3; $f++) {
    $cuenta = 0;
    for ($c=0; $c<9; $c++) {
        if ($carton[$f][$c] != 0) $cuenta++;
    }
    while ($cuenta > 5) {
        $r = rand(0,8);
        if ($carton[$f][$r] != 0) {
            $carton[$f][$r] = 0;
            $cuenta--;
        }
    }
}
?>

<table>
<?php
for ($f=0; $f<3; $f++) {
    echo "<tr>";
    for ($c=0; $c<9; $c++) {
        $valor = $carton[$f][$c];
        if ($valor == 0) {
            echo "<td id='vacia'></td>";
        } else {
            echo "<td id='rellena'><div id='numerito'>$valor</div>$valor</td>";
        }
    }
    echo "</tr>";
}
?>
</table>

</body>
</html>
