<?php
// validarLogin.php - ESTE ARCHIVO SOLO SE EJECUTA DESDE EL SUBMIT DEL FORMULARIO

session_start();

// 1. Conexión a la Base de Datos
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// 2. Obtener datos del formulario
// Aquí no necesitamos verificar si existe $_POST, asumimos que viene del formulario.
$nombre_ingresado = $_POST['usuario'];
$password_ingresada = $_POST['password'];


// 3. CONSULTA SEGURA PERO SIN HASHING: 
// CRÍTICA: La tabla debe ser 'Usuario' y la columna 'nombre'.
$stmt = $conexion->prepare("SELECT nombre FROM Usuario WHERE nombre = ? AND password = ?");

if ($stmt === false) {
  die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param("ss", $nombre_ingresado, $password_ingresada);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
  // ÉXITO
  $_SESSION['usuario'] = $nombre_ingresado;
  header("Location: PaginaLinux/index.php");
  exit();
} else {
  // FALLO
  echo "<script>
        alert('Usuario o contraseña incorrectos');
        window.location.href='login.php';
    </script>";
}

$stmt->close();
$conexion->close();
