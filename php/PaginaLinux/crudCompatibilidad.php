<?php
// Acción


$conexion = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($conexion->connect_error) {
  die("Error: " . $conexion->connect_error);
}



$accion = $_GET['accion'] ?? 'leer';

// ----------------------
// CREAR REGISTRO
// ----------------------
if ($accion === 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $conexion->query("
        INSERT INTO Compatibilidad (id_laptop, id_distribucion, nivel)
        VALUES ('{$_POST['id_laptop']}', '{$_POST['id_distribucion']}', '{$_POST['nivel']}')
    ");
  header("Location: ?accion=leer");
  exit;
}

// ----------------------
// EDITAR REGISTRO
// ----------------------
if ($accion === 'editar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $conexion->query("
        UPDATE Compatibilidad SET 
        id_laptop='{$_POST['id_laptop']}',
        nivel='{$_POST['nivel']}'
        WHERE id_compatibilidad={$_GET['id']}
    ");
  header("Location: ?accion=leer");
  exit;
}

// ----------------------
// ELIMINAR REGISTRO
// ----------------------
if ($accion === 'eliminar') {
  $conexion->query("DELETE FROM Compatibilidad WHERE id_compatibilidad={$_GET['id']}");
  header("Location: ?accion=leer");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Compatibilidad</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <div class="container mt-4">

    <?php
    // ----------------------------------------
    // FORMULARIO CREAR Y EDITAR
    // ----------------------------------------
    if ($accion === 'nuevo' || $accion === 'editar'):

      $edit = ['id_laptop' => '', 'id_distribucion' => '', 'nivel' => ''];

      if ($accion === 'editar') {
        $id = $_GET['id'];
        $edit = $conexion->query("SELECT * FROM Compatibilidad WHERE id_compatibilidad=$id")->fetch_assoc();
      }
    ?>

      <h2 class="mb-4"><?php echo $accion === 'nuevo' ? 'Agregar Compatibilidad' : 'Editar Compatibilidad'; ?></h2>

      <form method="POST" action="?accion=<?php echo $accion === 'nuevo' ? 'crear' : 'editar&id=' . $_GET['id']; ?>">

        <!-- Laptop -->
        <div class="mb-3">
          <label class="form-label">Laptop</label>
          <select name="id_laptop" class="form-select" required>
            <?php
            $laps = $conexion->query("SELECT * FROM Laptop");
            while ($lp = $laps->fetch_assoc()):
              $sel = $lp['id_laptop'] == $edit['id_laptop'] ? "selected" : "";
            ?>
              <option value="<?= $lp['id_laptop'] ?>" <?= $sel ?>><?= $lp['modelo'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Distribución -->
        <div class="mb-3">
          <label class="form-label">Distribución Linux</label>
          <select name="id_distribucion" class="form-select" required>
            <?php
            $dist = $conexion->query("SELECT * FROM DistribucionLinux");
            while ($d = $dist->fetch_assoc()):
              $sel = $d['id_distribucion'] == $edit['id_distribucion'] ? "selected" : "";
            ?>
              <option value="<?= $d['id_distribucion'] ?>" <?= $sel ?>><?= $d['nombre'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Nivel -->
        <div class="mb-3">
          <label class="form-label">Nivel</label>
          <select name="nivel" class="form-select" required>
            <?php
            $niveles = ['Excelente', 'Buena', 'Parcial', 'No Compatible'];
            foreach ($niveles as $n):
              $sel = $n === $edit['nivel'] ? "selected" : "";
            ?>
              <option <?= $sel ?>><?= $n ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="?accion=leer" class="btn btn-secondary">Cancelar</a>
      </form>

    <?php
    // FIN DEL FORM
    else:

      // ----------------------------------------
      // LISTA (READ)
      // ----------------------------------------
    ?>

      <h2 class="mb-3">Compatibilidad</h2>

      <a href="?accion=nuevo" class="btn btn-primary mb-3">Agregar nuevo</a>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Laptop</th>
            <th>Distribución</th>
            <th>Nivel</th>
            <th width="180">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $q = "
            SELECT c.*, l.modelo, d.nombre 
            FROM Compatibilidad c
            INNER JOIN Laptop l ON c.id_laptop = l.id_laptop
            INNER JOIN DistribucionLinux d ON c.id_distribucion = d.id_distribucion
        ";
          $res = $conexion->query($q);

          while ($row = $res->fetch_assoc()):
          ?>
            <tr>
              <td><?= $row['id_compatibilidad'] ?></td>
              <td><?= $row['modelo'] ?></td>
              <td><?= $row['nombre'] ?></td>
              <td><?= $row['nivel'] ?></td>
              <td>
                <a href="?accion=editar&id=<?= $row['id_compatibilidad'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="?accion=eliminar&id=<?= $row['id_compatibilidad'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('¿Seguro que quieres eliminar?')">
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
