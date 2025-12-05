<?php
echo "<h2>Expresiones Regulares en PHP – Ejemplo con preg_match</h2>";

echo "<p>Una expresión regular sirve para comparar un valor con una secuencia y determinar si el valor cumple con dicha secuencia.</p>";

echo "<h3>Funciones disponibles</h3>";
echo "<ul>
        <li><b>ereg</b>: Sintaxis POSIX (obsoleta y eliminada en PHP 7)</li>
        <li><b>preg_match</b>: Sintaxis tipo Perl, más rápida y la recomendada</li>
      </ul>";

echo "<p>Ambas funciones eran sensibles a mayúsculas/minúsculas, pero <b>ereg ya no existe</b>. Siempre usa <b>preg_match</b>.</p>";


// ----------------------------------------------------
// EJEMPLO PRÁCTICO: Validar si un texto contiene solo letras
// ----------------------------------------------------

$valor = "HolaPHP";

// Expresión regular:
// ^     inicio
// [A-Za-z]+   una o más letras
// $     final
$expresion = "/^[A-Za-z]+$/";

echo "<h3>Ejemplo: validar si una cadena contiene solo letras</h3>";
echo "Valor evaluado: <b>$valor</b><br>";

// preg_match devuelve:
// 1 → sí coincide
// 0 → no coincide
// false → error
if (preg_match($expresion, $valor, $coincidencias)) {
  echo "Resultado: <span style='color:green'>La cadena SÍ cumple la expresión.</span><br>";
  echo "Coincidencia encontrada: <pre>";
  print_r($coincidencias);
  echo "</pre>";
} else {
  echo "Resultado: <span style='color:red'>La cadena NO cumple la expresión.</span><br>";
}

echo "<hr>";


// ----------------------------------------------------
// OTRO EJEMPLO: Detectar un correo electrónico simple
// ----------------------------------------------------

$correo = "usuario@example.com";
$expCorreo = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";

echo "<h3>Ejemplo: validar correo electrónico</h3>";
echo "Correo evaluado: <b>$correo</b><br>";

if (preg_match($expCorreo, $correo, $partes)) {
  echo "Resultado: <span style='color:green'>Correo válido.</span><br>";
  echo "Coincidencia: <pre>";
  print_r($partes);
  echo "</pre>";
} else {
  echo "Resultado: <span style='color:red'>Correo inválido.</span><br>";
}
