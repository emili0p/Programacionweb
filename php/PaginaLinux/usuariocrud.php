<?php
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error en la conexión: " . $conexion->connect_error);
}

/* --- Crear registro --- */
if (isset($_POST['crear'])) {
  $nombre   = $_POST['nombre'];
  $correo   = $_POST['correo'];
  $telefono = $_POST['telefono'];

  $sql = "INSERT INTO usuarios (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
  $conexion->query($sql);
}

/* --- Eliminar registro --- */
if (isset($_GET['eliminar'])) {
  $id = $_GET['eliminar'];
  $conexion->query("DELETE FROM usuarios WHERE id_usuario = $id");
}

/* --- Actualizar registro --- */
if (isset($_POST['actualizar'])) {
  $id       = $_POST['id_usuario'];
  $nombre   = $_POST['nombre'];
  $correo   = $_POST['correo'];
  $telefono = $_POST['telefono'];

  $conexion->query("UPDATE Usuarios SET nombre='$nombre', correo='$correo', telefono='$telefono' WHERE id_usuario=$id");
}

/* --- Obtener registro a editar --- */
$editando = null;
if (isset($_GET['editar'])) {
  $id_edit = $_GET['editar'];
  $res = $conexion->query("SELECT * FROM Usuarios WHERE id_usuario = $id_edit");
  $editando = $res->fetch_assoc();
}

/* --- Consultar todos --- */
$resultado = $conexion->query("SELECT * FROM Usuarios ORDER BY id_usuario ASC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Usuarios</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef1f5;
      padding: 20px;
    }

    h1 {
      text-align: center;
      color: #003366;
    }

    .contenedor {
      width: 85%;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 25px;
    }

    th,
    td {
      border: 1px solid #d1d1d1;
      padding: 10px;
      text-align: center;
    }

    th {
      background: #005bbb;
      color: white;
    }

    .btn {
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }

    .btn-editar {
      background: #ffa500;
    }

    .btn-eliminar {
      background: #cc0000;
    }

    .btn-volver {
      background: #444;
      margin-bottom: 20px;
      display: inline-block;
    }

    .formulario {
      margin-top: 30px;
      padding: 20px;
      background: #f7f9fc;
      border-radius: 8px;
    }

    input[type="text"],
    input[type="email"] {
      width: 90%;
      padding: 10px;
      margin: 6px 0;
      border: 1px solid #aaa;
      border-radius: 6px;
    }

    button {
      background: #007bff;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>

<body>

  <h1>Gestión de Usuarios</h1>

  <div class="contenedor">

    <a class="btn btn-volver" href="index.php">⬅ Regresar</a>

    <h2><?php echo $editando ? "Editar Usuario" : "Crear Usuario"; ?></h2>

    <!-- FORMULARIO -->
    <form class="formulario" method="POST">

      <?php if ($editando): ?>
        <input type="hidden" name="id_usuario" value="<?= $editando['id_usuario'] ?>">
      <?php endif; ?>

      <label>Nombre:</label><br>
      <input type="text" name="nombre" required value="<?= $editando['nombre'] ?? '' ?>"><br>

      <label>Correo:</label><br>
      <input type="email" name="correo" required value="<?= $editando['correo'] ?? '' ?>"><br>

      <label>Teléfono:</label><br>
      <input type="text" name="telefono" required value="<?= $editando['telefono'] ?? '' ?>"><br>

      <?php if ($editando): ?>
        <button type="submit" name="actualizar">Actualizar</button>
      <?php else: ?>
        <button type="submit" name="crear">Crear</button>
      <?php endif; ?>
    </form>

    <!-- TABLA -->
    <table>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>

      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?= $fila['id_usuario'] ?></td>
          <td><?= $fila['nombre'] ?></td>
          <td><?= $fila['correo'] ?></td>
          <td><?= $fila['telefono'] ?></td>

          <td>
            <a class="btn btn-editar" href="?editar=<?= $fila['id_usuario'] ?>">Editar</a>
            <a class="btn btn-eliminar"
              href="?eliminar=<?= $fila['id_usuario'] ?>"
              onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">
              Eliminar
            </a>
          </td>
        </tr>
      <?php endwhile; ?>

    </table>

  </div>

</body>

</html>
