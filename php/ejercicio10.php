<?php
echo "<h2>Arreglo por posición</h2>";

$arreglo8 = array(100, 200, 300);

// Mostrar el arreglo completo
echo "<pre>";
print_r($arreglo8);
echo "</pre><br>";

// Acceso por índice
echo $arreglo8[0] . "<br>"; // 100
echo $arreglo8[1] . "<br>"; // 200
echo $arreglo8[2] . "<br>"; // 300


echo "<h2>Arreglo por nombre (arreglo asociativo)</h2>";

$arreglo9 = array(
    'llave1' => 'valor1',
    'llave2' => 'valor2'
);

// Mostrar el arreglo completo
echo "<pre>";
print_r($arreglo9);
echo "</pre><br>";

// Acceso por nombre
echo $arreglo9['llave1'] . "<br>"; // valor1
echo $arreglo9['llave2'] . "<br>"; // valor2


echo "<h2>Varias formas de acceder a un elemento</h2>";

// Forma 1
echo $arreglo9['llave1'] . "<br>";

// Forma 2 (solo si el arreglo es numérico) — EN ASOCIATIVO NO FUNCIONA
// echo $arreglo9[0] . "<br>"; // ERROR aquí porque no existe índice 0

// Forma 3 (interpolación dentro de comillas dobles)
echo "$arreglo9[llave1] <br>";

// Si fuera un arreglo por posición:
echo $arreglo8[0] . "<br>"; // funciona porque sí existe índice 0
echo "$arreglo8[0] <br>";   // también funciona dentro de comillas dobles

?>

