<?php

/*************************************
 * CONEXIÓN A BASE DE DATOS
 *************************************/
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "tiendalinux";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

/*************************************
 * AGREGAR REGISTRO
 *************************************/
if (isset($_POST["agregar"])) {
  $nombre  = $_POST["nombre"];
  $version = $_POST["version"];
  $tipo    = $_POST["tipo"];
  $sitio   = $_POST["sitio_oficial"];

  $sql = "INSERT INTO DistribucionLinux (nombre, version, tipo, sitio_oficial)
            VALUES ('$nombre', '$version', '$tipo', '$sitio')";
  $conexion->query($sql);
}

/*************************************
 * ELIMINAR REGISTRO
 *************************************/
if (isset($_GET["eliminar"])) {
  $id = intval($_GET["eliminar"]);
  $conexion->query("DELETE FROM DistribucionLinux WHERE id_distribucion = $id");
}

/*************************************
 * ACTUALIZAR REGISTRO
 *************************************/
if (isset($_POST["actualizar"])) {
  $id      = intval($_POST["id"]);
  $nombre  = $_POST["nombre"];
  $version = $_POST["version"];
  $tipo    = $_POST["tipo"];
  $sitio   = $_POST["sitio_oficial"];

  $sql = "UPDATE DistribucionLinux 
            SET nombre='$nombre', version='$version', tipo='$tipo', sitio_oficial='$sitio'
            WHERE id_distribucion = $id";

  $conexion->query($sql);
}

/*************************************
 * OBTENER DATOS PARA EDITAR
 *************************************/
$editando = false;
$registroEditar = null;

if (isset($_GET["editar"])) {
  $editando = true;
  $id = intval($_GET["editar"]);
  $res = $conexion->query("SELECT * FROM DistribucionLinux WHERE id_distribucion = $id");
  $registroEditar = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Distribuciones Linux</title>

  <!-- ESTILOS BONITOS -->
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: #eef2f5;
      margin: 0;
      padding: 30px;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      color: #1e293b;
      font-size: 32px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: #ffffff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .card {
      background: #f8fafc;
      padding: 20px;
      border-radius: 12px;
      border: 1px solid #cbd5e1;
      margin-bottom: 25px;
    }

    h2 {
      color: #0f172a;
      margin-bottom: 12px;
    }

    form input {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px;
      border-radius: 8px;
      border: 1px solid #94a3b8;
      background: #ffffff;
      font-size: 14px;
    }

    .btn {
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-decoration: none;
      color: white;
      font-size: 14px;
    }

    .btn-add {
      background: #2563eb;
      width: 100%;
    }

    .btn-edit {
      background: #0ea5e9;
    }

    .btn-delete {
      background: #dc2626;
    }

    .btn-back {
      background: #475569;
      margin-bottom: 20px;
      display: inline-block;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
    }

    table th {
      background: #1e293b;
      color: white;
      padding: 12px;
    }

    table td {
      padding: 12px;
      border-bottom: 1px solid #e2e8f0;
    }

    tr:hover {
      background: #f1f5f9;
    }
  </style>
</head>

<body>

  <h1>CRUD — Distribuciones Linux</h1>

  <div class="container">

    <!-- BOTÓN REGRESAR -->
    <a href="index.php" class="btn btn-back">⬅ Regresar</a>

    <!-- FORMULARIO -->
    <div class="card">
      <h2><?= $editando ? "Editar Distribución" : "Agregar Nueva Distribución"; ?></h2>

      <form method="POST">

        <?php if ($editando): ?>
          <input type="hidden" name="id"
            value="<?= $registroEditar['id_distribucion'] ?>">
        <?php endif; ?>

        <label>Nombre</label>
        <input type="text" name="nombre" required
          value="<?= $editando ? $registroEditar['nombre'] : '' ?>">

        <label>Versión</label>
        <input type="text" name="version" required
          value="<?= $editando ? $registroEditar['version'] : '' ?>">

        <label>Tipo</label>
        <input type="text" name="tipo" required
          value="<?= $editando ? $registroEditar['tipo'] : '' ?>">

        <label>Sitio Oficial</label>
        <input type="url" name="sitio_oficial" required
          value="<?= $editando ? $registroEditar['sitio_oficial'] : '' ?>">

        <?php if ($editando): ?>
          <button class="btn btn-edit" name="actualizar">Actualizar</button>
        <?php else: ?>
          <button class="btn btn-add" name="agregar">Agregar Distribución</button>
        <?php endif; ?>
      </form>
    </div>

    <!-- TABLA -->
    <h2>Listado de Distribuciones</h2>

    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Versión</th>
        <th>Tipo</th>
        <th>Sitio</th>
        <th>Acciones</th>
      </tr>

      <?php
      $result = $conexion->query("SELECT * FROM DistribucionLinux");

      while ($row = $result->fetch_assoc()):
      ?>
        <tr>
          <td><?= $row["id_distribucion"] ?></td>
          <td><?= $row["nombre"] ?></td>
          <td><?= $row["version"] ?></td>
          <td><?= $row["tipo"] ?></td>
          <td><a href="<?= $row["sitio_oficial"] ?>" target="_blank">Visitar</a></td>

          <td>
            <a class="btn btn-edit" href="?editar=<?= $row['id_distribucion'] ?>">Editar</a>
            <a class="btn btn-delete" href="?eliminar=<?= $row['id_distribucion'] ?>" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>

  </div>

</body>

</html>
