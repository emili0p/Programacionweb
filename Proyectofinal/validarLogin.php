<?php
session_start();

// Conexión BD
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

$nombre_ingresado = $_POST['usuario'];
$password_ingresada = $_POST['password'];

// 1. Buscar solo por nombre
$stmt = $conexion->prepare("SELECT id_usuario, password FROM Usuario WHERE nombre = ?");
$stmt->bind_param("s", $nombre_ingresado);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {

  $fila = $resultado->fetch_assoc();
  $hash_guardado = $fila['password'];

  // 2. Comparar hash
  if (password_verify($password_ingresada, $hash_guardado)) {

    // LOGIN CORRECTO
    $_SESSION['usuario'] = $nombre_ingresado;
    $_SESSION['id_usuario'] = $fila['id_usuario'];

    header("Location: index.php");
    exit();
  } else {
    // Contraseña incorrecta
    echo "<script>
            alert('Contraseña incorrecta');
            window.location.href='login.php';
        </script>";
  }
} else {
  // Usuario no existe
  echo "<script>
        alert('Usuario no encontrado');
        window.location.href='login.php';
    </script>";
}

$stmt->close();
$conexion->close();
