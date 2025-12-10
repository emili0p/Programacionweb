<?php
session_start();

// Cambia estos datos con los tuyos
$conexion = new mysqli("localhost", "root", "", "mibase");

$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta preparada para evitar SQL Injection
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario=? AND password=?");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
  $_SESSION['usuario'] = $usuario;
  header("Location: PaginaLinux/index.php"); // Redirige a la tienda
  exit();
} else {
  echo "<script>
        alert('Usuario o contraseña incorrectos');
        window.location.href='login.php';
    </script>";
}
