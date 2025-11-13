<?php
// En comillas simples NO se interpretan \t, \r\n, etc.
$texto1 = '\tTabulador\r\n\\Backslash\'';
echo "<pre>$texto1</pre><br>";
// Salida literal:
// \tTabulador\r\n\Backslash'

// En comillas dobles SÍ se interpretan secuencias de escape
$texto2 = "\tTabulador\r\n\\Backslash\" ";
echo "<pre>$texto2</pre><br>";

/*
  Salida de $texto2:
      Tabulador
  \Backslash"
  */
