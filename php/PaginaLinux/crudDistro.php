<?php

/*************************************
 * CONEXIÓN A BASE DE DATOS
 *************************************/
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "tiendalinux";

// Si usas XAMPP en Linux evita el socket manual
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

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f9;
      margin: 0;
      padding: 40px;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 25px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 25px;
    }

    table th,
    table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: center;
    }

    table th {
      background: #34495e;
      color: white;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      color: white;
    }

    .btn-edit {
      background: #3498db;
    }

    .btn-delete {
      background: #e74c3c;
    }

    .btn-add {
      background: #27ae60;
      width: 100%;
    }

    form input {
      width: 100%;
      padding: 8px;
      margin: 6px 0;
      border-radius: 5px;
      border: 1px solid #aaa;
    }

    .card {
      background: #ecf0f1;
      padding: 15px;
      border-radius: 10px;
      margin-top: 20px;
    }
  </style>
</head>

<body>

  <h1>CRUD - Distribuciones Linux</h1>

  <div class="container">

    <!-- FORMULARIO -->
    <div class="card">
      <h2><?php echo $editando ? "Editar Distribución" : "Agregar Nueva Distribución"; ?></h2>

      <form method="POST">

        <?php if ($editando): ?>
          <input type="hidden" name="id" value="<?= $registroEditar['id_distribucion'] ?>">
        <?php endif; ?>

        <label>Nombre</label>
        <input type="text" name="nombre" required value="<?= $editando ? $registroEditar['nombre'] : '' ?>">

        <label>Versión</label>
        <input type="text" name="version" required value="<?= $editando ? $registroEditar['version'] : '' ?>">

        <label>Tipo</label>
        <input type="text" name="tipo" required value="<?= $editando ? $registroEditar['tipo'] : '' ?>">

        <label>Sitio Oficial</label>
        <input type="url" name="sitio_oficial" required value="<?= $editando ? $registroEditar['sitio_oficial'] : '' ?>">

        <?php if ($editando): ?>
          <button class="btn btn-edit" name="actualizar">Actualizar</button>
        <?php else: ?>
          <button class="btn btn-add" name="agregar">Agregar Distribución</button>
        <?php endif; ?>
      </form>
    </div>

    <!-- TABLA -->
    <h2 style="margin-top: 40px;">Listado de Distribuciones</h2>

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
