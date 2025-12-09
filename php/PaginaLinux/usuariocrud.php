<?php
// --- CONEXIÓN -------------------------
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_errno) {
  die("Error de conexión: " . $conexion->connect_error);
}

// --- AGREGAR USUARIO ------------------
if (isset($_POST['agregar'])) {
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];

  $conexion->query("INSERT INTO Usuario (nombre, correo, telefono)
                      VALUES ('$nombre', '$correo', '$telefono')");
  header("Location: usuarios.php");
  exit();
}

// --- EDITAR USUARIO -------------------
if (isset($_POST['editar'])) {
  $id = $_POST['id_usuario'];
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];

  $conexion->query("UPDATE Usuario SET 
                        nombre='$nombre',
                        correo='$correo',
                        telefono='$telefono'
                      WHERE id_usuario=$id");
  header("Location: usuarios.php");
  exit();
}

// --- ELIMINAR USUARIO -----------------
if (isset($_GET['eliminar'])) {
  $id = $_GET['eliminar'];
  $conexion->query("DELETE FROM Usuario WHERE id_usuario=$id");
  header("Location: usuarios.php");
  exit();
}

// --- OBTENER USUARIO PARA EDITAR ------
$usuarioEditar = null;
if (isset($_GET['editar'])) {
  $id = $_GET['editar'];
  $res = $conexion->query("SELECT * FROM Usuario WHERE id_usuario=$id");
  $usuarioEditar = $res->fetch_assoc();
}

// --- OBTENER TODOS LOS USUARIOS -------
$usuarios = $conexion->query("SELECT * FROM Usuario");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-4">

    <h2 class="text-center mb-4">Gestión de Usuarios</h2>

    <!-- FORMULARIO -->
    <div class="card shadow-sm mb-4">
      <div class="card-header bg-primary text-white">
        <?= $usuarioEditar ? "Editar Usuario" : "Agregar Usuario" ?>
      </div>
      <div class="card-body">

        <form method="POST">

          <?php if ($usuarioEditar): ?>
            <input type="hidden" name="id_usuario" value="<?= $usuarioEditar['id_usuario'] ?>">
          <?php endif; ?>

          <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control"
              value="<?= $usuarioEditar['nombre'] ?? '' ?>" required>
          </div>

          <div class="mb-3">
            <label>Correo:</label>
            <input type="email" name="correo" class="form-control"
              value="<?= $usuarioEditar['correo'] ?? '' ?>" required>
          </div>

          <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" class="form-control"
              value="<?= $usuarioEditar['telefono'] ?? '' ?>" required>
          </div>

          <?php if ($usuarioEditar): ?>
            <button type="submit" name="editar" class="btn btn-warning">Actualizar</button>
            <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
          <?php else: ?>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
          <?php endif; ?>

        </form>

      </div>
    </div>

    <!-- TABLA DE USUARIOS -->
    <div class="card shadow-sm">
      <div class="card-header bg-dark text-white">Lista de Usuarios</div>
      <div class="card-body">

        <table class="table table-bordered table-hover">
          <thead class="table-secondary">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php while ($row = $usuarios->fetch_assoc()): ?>
              <tr>
                <td><?= $row['id_usuario'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td><?= $row['correo'] ?></td>
                <td><?= $row['telefono'] ?></td>
                <td>
                  <a href="usuarios.php?editar=<?= $row['id_usuario'] ?>" class="btn btn-sm btn-warning">Editar</a>
                  <a href="usuarios.php?eliminar=<?= $row['id_usuario'] ?>"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>

        </table>

      </div>
    </div>

  </div>

</body>

</html>
