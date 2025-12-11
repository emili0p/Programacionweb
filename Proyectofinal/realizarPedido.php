<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: ../login.php");
  exit();
}

include "../plantilla/header.php";
include "../plantilla/menu.php";

$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");

if ($conexion->connect_error) {
  die("Error al conectar: " . $conexion->connect_error);
}

if (!isset($_GET['id'])) {
  echo "<script>alert('ID inválido'); window.location='../Tienda.php';</script>";
  exit();
}

$id = intval($_GET['id']);

$stmt = $conexion->prepare("SELECT * FROM Laptop WHERE id_laptop = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$lap = $stmt->get_result()->fetch_assoc();

if (!$lap) {
  echo "<script>alert('Laptop no encontrada'); window.location='../Tienda.php';</script>";
  exit();
}
?>

<h2 style="padding:20px;">Estás pidiendo: <?= htmlspecialchars($lap['nombre']) ?></h2>
