<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: ../login.php");
  exit();
}

// Conexión a la base de datos
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error en la conexión: " . $conexion->connect_error);
}

// Validar ID del pedido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<script>alert('ID inválido'); window.location='../Tienda.php';</script>";
  exit();
}

$id_pedido = intval($_GET['id']);

// Traer información del pedido
$sql = "
    SELECT 
        p.id_pedido, p.fecha, p.estado,
        u.nombre AS usuario_nombre, 
        u.correo AS usuario_correo,
        u.telefono AS usuario_telefono,
        l.nombre AS laptop_nombre,
        l.precio AS laptop_precio
    FROM Pedido p
    INNER JOIN Usuario u ON p.id_usuario = u.id_usuario
    INNER JOIN Laptop l ON p.id_laptop = l.id_laptop
    WHERE p.id_pedido = ?
";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_pedido);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si existe
if ($result->num_rows === 0) {
  echo "<script>alert('Pedido no encontrado'); window.location='../Tienda.php';</script>";
  exit();
}

$pedido = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Pedido #<?php echo $pedido['id_pedido']; ?></title>
</head>

<body>

  <h1>Pedido #<?php echo $pedido['id_pedido']; ?></h1>

  <h2>Información del Pedido</h2>
  <ul>
    <li><b>Fecha:</b> <?php echo $pedido['fecha']; ?></li>
    <li><b>Estado:</b> <?php echo $pedido['estado']; ?></li>
  </ul>

  <h2>Datos del Cliente</h2>
  <ul>
    <li><b>Nombre:</b> <?php echo $pedido['usuario_nombre']; ?></li>
    <li><b>Correo:</b> <?php echo $pedido['usuario_correo']; ?></li>
    <li><b>Teléfono:</b> <?php echo $pedido['usuario_telefono']; ?></li>
  </ul>

  <h2>Información de la Laptop</h2>
  <ul>
    <li><b>Modelo:</b> <?php echo $pedido['laptop_nombre']; ?></li>
    <li><b>Precio:</b> $<?php echo $pedido['laptop_precio']; ?></li>
  </ul>

  <br>
  <a href="../Tienda.php">Volver a la tienda</a>

</body>

</html>
