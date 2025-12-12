<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit();
}

include "plantilla/header.php";
include "plantilla/menu.php";

$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
$laptops = $conexion->query("SELECT * FROM Laptop");
?>

<h2 style="padding:20px;">Laptops disponibles</h2>

<div style="display:flex; gap:20px; flex-wrap:wrap; padding:20px;">
  <?php foreach ($laptops as $lap): ?>
    <div style="border:1px solid #ccc; padding:20px; width:250px; border-radius:10px;">
      <h3><?= $lap['nombre'] ?></h3>
      <p><?= $lap['descripcion'] ?></p>
      <a href="realizarPedido.php?id=<?= $lap['id_laptop'] ?>"
        style="background:#0066ff; color:white; padding:10px; text-decoration:none; border-radius:5px;">
        Pedir
      </a>
    </div>
  <?php endforeach; ?>
</div>
