<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

include "plantilla/header.php";
include "plantilla/menu.php";

$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error al conectar: " . $conexion->connect_error);
}

// Validar ID de laptop
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "<script>alert('ID inválido'); window.location='Tienda.php';</script>";
  exit();
}

$id_laptop = intval($_GET['id']);
$id_usuario = $_SESSION['id_usuario'];

// Verificar que la laptop exista
$stmt = $conexion->prepare("SELECT * FROM Laptop WHERE id_laptop = ?");
$stmt->bind_param("i", $id_laptop);
$stmt->execute();
$lap = $stmt->get_result()->fetch_assoc();

if (!$lap) {
  echo "<script>alert('Laptop no encontrada'); window.location='Tienda.php';</script>";
  exit();
}

// Insertar pedido
$stmt = $conexion->prepare("INSERT INTO Pedido (id_usuario, id_laptop, fecha, estado) VALUES (?, ?, NOW(), 'Pendiente')");
$stmt->bind_param("ii", $id_usuario, $id_laptop);
$stmt->execute();

$id_pedido = $conexion->insert_id;

// Traer info del usuario para PDF
$stmt = $conexion->prepare("SELECT nombre, correo, telefono FROM Usuario WHERE id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

// ======================
//    GENERAR PDF
// ======================
require("fpdf/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(0, 10, "Comprobante de Pedido", 0, 1, "C");

$pdf->SetFont("Arial", "", 12);
$pdf->Ln(5);

// Datos del pedido
$pdf->Cell(0, 8, "Pedido #: $id_pedido", 0, 1);
$pdf->Cell(0, 8, "Fecha: " . date("Y-m-d"), 0, 1);
$pdf->Cell(0, 8, "Estado: Pendiente", 0, 1);

$pdf->Ln(5);

// Datos del usuario
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, "Datos del Cliente", 0, 1);

$pdf->SetFont("Arial", "", 12);
$pdf->Cell(0, 8, "Nombre: " . $usuario['nombre'], 0, 1);
$pdf->Cell(0, 8, "Correo: " . $usuario['correo'], 0, 1);
$pdf->Cell(0, 8, "Teléfono: " . $usuario['telefono'], 0, 1);

$pdf->Ln(5);

// Datos de la laptop
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(0, 8, "Laptop Solicitada", 0, 1);

$pdf->SetFont("Arial", "", 12);
$pdf->Cell(0, 8, "Modelo: " . $lap['nombre'], 0, 1);
$pdf->Cell(0, 8, "Precio: $" . $lap['precio'], 0, 1);

$file = "pedido_$id_pedido.pdf";
$pdf->Output("F", $file);

// ======================
//    DESCARGAR PDF
// ======================
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=$file");
readfile($file);

// Borrar temporal
unlink($file);
exit();
