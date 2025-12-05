<?php
echo "<h2>Ejemplo de ciclo do...while en PHP</h2>";

// Crear y llenar un arreglo
$arreglo = array();
$cuantosElementos = 5;

for ($contador = 0; $contador < $cuantosElementos; ++$contador) {
  $arreglo[] = "Elemento # $contador";
}

// Desplegar el arreglo usando do...while
$contador = 0;

do {
  echo $arreglo[$contador] . "<br>";
  ++$contador;
} while ($contador < $cuantosElementos);

/*
Salida esperada:
Elemento # 0
Elemento # 1
Elemento # 2
Elemento # 3
Elemento # 4
*/
