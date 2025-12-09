<?php
$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error: " . $conexion->connect_error);
}

// Acción
$accion = $_GET['accion'] ?? 'leer';

// ----------------------
// CREAR
// ----------------------
if ($accion === 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $conexion->query("
        INSERT INTO Pedido (id_usuario, id_laptop, fecha, estado)
        VALUES (
            '{$_POST['id_usuario']}',
            '{$_POST['id_laptop']}',
            '{$_POST['fecha']}',
            '{$_POST['estado']}'
        )
    ");
  header("Location: ?accion=leer");
  exit;
}

// ----------------------
// EDITAR
// ----------------------
if ($accion === 'editar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_GET['id'];
  $conexion->query("
        UPDATE Pedido SET
        id_usuario='{$_POST['id_usuario']}',
        id_laptop='{$_POST['id_laptop']}',
        fecha='{$_POST['fecha']}',
        estado='{$_POST['estado']}'
        WHERE id_pedido=$id
    ");
  header("Location: ?accion=leer");
  exit;
}

// ----------------------
// ELIMINAR
// ----------------------
if ($accion === 'eliminar') {
  $conexion->query("DELETE FROM Pedido WHERE id_pedido={$_GET['id']}");
  header("Location: ?accion=leer");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Pedido</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-4">

    <!-- Botón de regreso al menú -->
    <div class="mb-3">
      <a href="index.html" class="btn btn-dark">&larr; Regresar al menú</a>
    </div>

    <?php
    // ----------------------
    // FORMULARIO CREAR / EDITAR
    // ----------------------
    if ($accion === 'nuevo' || $accion === 'editar'):

      $edit = ['id_usuario' => '', 'id_laptop' => '', 'fecha' => '', 'estado' => ''];

      if ($accion === 'editar') {
        $id = $_GET['id'];
        $edit = $conexion->query("SELECT * FROM Pedido WHERE id_pedido=$id")->fetch_assoc();
      }
    ?>

      <h2 class="mb-4">
        <?= $accion === 'nuevo' ? 'Crear Pedido' : 'Editar Pedido' ?>
      </h2>

      <form method="POST" action="?accion=<?= $accion === 'nuevo' ? 'crear' : 'editar&id=' . $_GET['id']; ?>">

        <!-- Usuario -->
        <div class="mb-3">
          <label class="form-label">Usuario</label>
          <select name="id_usuario" class="form-select" required>
            <?php
            $usuarios = $conexion->query("SELECT * FROM Usuario");
            while ($u = $usuarios->fetch_assoc()):
              $sel = ($u['id_usuario'] == $edit['id_usuario']) ? 'selected' : '';
            ?>
              <option value="<?= $u['id_usuario'] ?>" <?= $sel ?>>
                <?= $u['nombre'] ?> (ID <?= $u['id_usuario'] ?>)
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Laptop -->
        <div class="mb-3">
          <label class="form-label">Laptop</label>
          <select name="id_laptop" class="form-select" required>
            <?php
            $laps = $conexion->query("SELECT * FROM Laptop");
            while ($lp = $laps->fetch_assoc()):
              $sel = ($lp['id_laptop'] == $edit['id_laptop']) ? 'selected' : '';
            ?>
              <option value="<?= $lp['id_laptop'] ?>" <?= $sel ?>>
                <?= $lp['modelo'] ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Fecha -->
        <div class="mb-3">
          <label class="form-label">Fecha</label>
          <input type="date" class="form-control" name="fecha" required
            value="<?= $edit['fecha'] ?>">
        </div>

        <!-- Estado -->
        <div class="mb-3">
          <label class="form-label">Estado</label>
          <select name="estado" class="form-select" required>
            <?php
            $estados = ['Pendiente', 'Procesando', 'Enviado', 'Entregado', 'Cancelado'];
            foreach ($estados as $e):
              $sel = ($e == $edit['estado']) ? 'selected' : '';
            ?>
              <option <?= $sel ?>><?= $e ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="?accion=leer" class="btn btn-secondary">Cancelar</a>

      </form>

    <?php
    // ----------------------
    // LISTAR (READ)
    // ----------------------
    else:
    ?>

      <h2 class="mb-3">Pedidos</h2>

      <a href="?accion=nuevo" class="btn btn-primary mb-3">Agregar Pedido</a>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Laptop</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th width="180">Acciones</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $query = "
          SELECT p.*, u.nombre AS usuario, l.modelo AS laptop
          FROM Pedido p
          INNER JOIN Usuario u ON p.id_usuario = u.id_usuario
          INNER JOIN Laptop l ON p.id_laptop = l.id_laptop
          ";
          $res = $conexion->query($query);

          while ($row = $res->fetch_assoc()):
          ?>
            <tr>
              <td><?= $row['id_pedido'] ?></td>
              <td><?= $row['usuario'] ?></td>
              <td><?= $row['laptop'] ?></td>
              <td><?= $row['fecha'] ?></td>
              <td><?= $row['estado'] ?></td>
              <td>
                <a href="?accion=editar&id=<?= $row['id_pedido'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="?accion=eliminar&id=<?= $row['id_pedido'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('¿Eliminar pedido?')">
                  Eliminar
                </a>
              </td>
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>

    <?php endif; ?>

  </div>
</body>

</html>
