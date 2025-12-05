<?php
echo "<h2>Bitácoras de errores en PHP</h2>";

echo "<h3>Ejemplos de error_log()</h3>";

// Tipos de mensajes
error_log('Mensaje de error tipo 0 (log del servidor).', 0);

// Enviar error por correo (si el servidor lo permite)
error_log('Mensaje de error tipo 1 (email).', 1, 'direccion@email.com');

// Guardar en un archivo de bitácora personalizado
error_log('Mensaje de error tipo 3 (archivo de log).', 3, 'bitacora.log');


// --------------------------------------------------------
// DEFINIR FUNCIÓN MANEJADORA DE ERRORES
// --------------------------------------------------------

function manejaError($tipo, $descripcion, $archivo, $linea)
{
  // Evitar aviso de zona horaria faltante en PHP 5.1+ 
  if (version_compare(PHP_VERSION, '5.1.0', '>=')) {
    date_default_timezone_set('America/Mexico_City');
  }

  // Formato del mensaje para la bitácora
  $error = date('j/n/Y G:i:s') .
    "\tTipo: $tipo" .
    "\tDescripción: $descripcion" .
    "\tArchivo: $archivo" .
    "\tLínea: $linea\r\n";

  // Guardar en bitácora personalizada
  error_log($error, 3, 'bitacora.log');
}

// --------------------------------------------------------
// ACTIVAR EL MANEJADOR DE ERRORES
// --------------------------------------------------------
set_error_handler('manejaError');

echo "<h3>Provocando un error para registrar en la bitácora…</h3>";

// --------------------------------------------------------
// PROVOCAR UN ERROR
// --------------------------------------------------------
// El @ evita que el error se muestre al usuario,
// pero igual será capturado por nuestra función.
$variable = @(10 / 0);

echo "Error provocado y registrado en <b>bitacora.log</b><br>";
