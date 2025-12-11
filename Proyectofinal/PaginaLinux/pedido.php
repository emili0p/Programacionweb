<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error: " . $conexion->connect_error);
}

$accion = $_GET['accion'] ?? 'tracking';

// ----------------------
// ACTUALIZAR ESTADO
// ----------------------
if ($accion === 'actualizar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_GET['id']);
  $estado = $_POST['estado'];

  $sql = "UPDATE Pedido SET estado='$estado' WHERE id_pedido=$id";

  if (!$conexion->query($sql)) {
    die("Error SQL (actualizar): " . $conexion->error);
  }

  header("Location: pedido.php?accion=tracking");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<?php
include __DIR__ .  "/../plantilla/header.php"; // Incluye session_start()
include __DIR__ . "/../plantilla/menu.php";
?>


<head>
  <meta charset="UTF-8">
  <title>Tracking de Pedidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #eef2f7;
    }

    .card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .status-step {
      display: inline-block;
      padding: 10px 18px;
      border-radius: 50px;
      margin-right: 8px;
      font-weight: bold;
    }

    .active-step {
      background: #00c853;
      color: white;
    }

    .inactive-step {
      background: #bbb;
      color: white;
    }
  </style>
</head>

<body>

  <div class="container mt-4">

    <!-- Botón de regreso -->
    <a href="index.html" class="btn btn-dark mb-3">&larr; Regresar</a>

    <h2 class="mb-4">Seguimiento de Pedidos</h2>

    <?php if ($accion === 'tracking'): ?>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Laptop</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Seguimiento</th>
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
              <td><strong><?= $row['estado'] ?></strong></td>
              <td>
                <a href="pedido.php?accion=ver&id=<?= $row['id_pedido'] ?>" class="btn btn-primary btn-sm">
                  Ver Tracking
                </a>
              </td>
            </tr>
          <?php endwhile; ?>

        </tbody>
      </table>

    <?php endif; ?>


    <?php if ($accion === 'ver'):
      $id = intval($_GET['id']);
      $res = $conexion->query("SELECT * FROM Pedido WHERE id_pedido=$id");
      $pedido = $res->fetch_assoc();

      $estados = ['Pendiente', 'Procesando', 'Enviado', 'Entregado'];
    ?>

      <div class="card p-4 mt-4">
        <h3>Pedido #<?= $pedido['id_pedido'] ?></h3>
        <p><strong>Estado actual:</strong> <?= $pedido['estado'] ?></p>

        <h5>Progreso</h5>
        <div class="mt-3">
          <?php foreach ($estados as $e): ?>
            <span class="status-step <?= ($pedido['estado'] === $e) ? 'active-step' : 'inactive-step' ?>">
              <?= $e ?>
            </span>
          <?php endforeach; ?>
        </div>

        <hr>

        <h4>Actualizar estado</h4>
        <form method="POST" action="pedido.php?accion=actualizar&id=<?= $pedido['id_pedido'] ?>">
          <select class="form-select mb-3" name="estado">
            <?php foreach ($estados as $e): ?>
              <option <?= $e === $pedido['estado'] ? 'selected' : '' ?>><?= $e ?></option>
            <?php endforeach; ?>
          </select>

          <button class="btn btn-success">Guardar</button>
          <a href="pedido.php?accion=tracking" class="btn btn-secondary">Regresar</a>
        </form>
      </div>
      <?php include __DIR__ . "/../plantilla/footer.php"; ?>
    <?php endif; ?>

  </div>

</body>

</html>
