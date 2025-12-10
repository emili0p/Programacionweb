<?php
session_start();

// 1. Conexión a la Base de Datos
// Cambia estos datos con los tuyos
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");

// Verificar conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// 2. Obtener datos del formulario
$usuario_ingresado = $_POST['usuario'];
$password_ingresada = $_POST['password'];

// 3. Consultar SOLO por el usuario (la contraseña la verificaremos después)
$stmt = $conexion->prepare("SELECT password FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario_ingresado);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
  // Usuario encontrado, obtener el hash de la BD
  $fila = $resultado->fetch_assoc();
  $hash_almacenado = $fila['password'];

  // 4. Verificar la contraseña ingresada contra el hash almacenado
  if (password_verify($password_ingresada, $hash_almacenado)) {
    // La contraseña es correcta, iniciar sesión
    $_SESSION['usuario'] = $usuario_ingresado;
    header("Location: PaginaLinux/index.php"); // Redirige a la tienda
    exit();
  }
}

// Si llega aquí, el usuario no fue encontrado o la contraseña fue incorrecta
echo "<script>
    alert('Usuario o contraseña incorrectos');
    window.location.href='login.php';
</script>";

$stmt->close();
$conexion->close();
