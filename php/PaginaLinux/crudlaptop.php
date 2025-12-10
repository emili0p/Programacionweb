<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($mysqli->connect_errno) {
  die("❌ Error al conectar a MySQL: " . $mysqli->connect_error);
}

$editando = false;
$data = [
  "nombre" => "",
  "marca" => "",
  "modelo" => "",
  "precio" => "",
  "procesador" => "",
  "memoria_ram" => "",
  "almacenamiento" => "",
  "pantalla" => "",
  "estado_libreboot" => "",
  "descripcion" => "",
  "imagen_principal" => ""
];

/* ============================
      EDITAR - CARGAR DATOS
============================ */
if (isset($_GET["editar"])) {
  $editando = true;
  $id_edit = intval($_GET["editar"]);
  $res = $mysqli->query("SELECT * FROM Laptop WHERE id_laptop = $id_edit");

  if ($res && $res->num_rows > 0) {
    $data = $res->fetch_assoc();
  } else {
    die("❌ Laptop no encontrada.");
  }
}

/* ============================
         GUARDAR (INSERTAR)
============================ */
if (isset($_POST["guardar"])) {

  if (!$editando) {
    $stmt = $mysqli->prepare("
            INSERT INTO Laptop 
            (nombre, marca, modelo, precio, procesador, memoria_ram, almacenamiento, pantalla, estado_libreboot, descripcion, imagen_principal)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

    $stmt->bind_param(
      "sssssssssss",
      $_POST["nombre"],
      $_POST["marca"],
      $_POST["modelo"],
      $_POST["precio"],
      $_POST["procesador"],
      $_POST["memoria_ram"],
      $_POST["almacenamiento"],
      $_POST["pantalla"],
      $_POST["estado_libreboot"],
      $_POST["descripcion"],
      $_POST["imagen_principal"]
    );

    $stmt->execute();
    $stmt->close();
  } else {
    /* ============================
                 GUARDAR CAMBIOS
        ============================ */
    $stmt = $mysqli->prepare("
            UPDATE Laptop SET 
                nombre=?, marca=?, modelo=?, precio=?, procesador=?, memoria_ram=?, 
                almacenamiento=?, pantalla=?, estado_libreboot=?, descripcion=?, imagen_principal=?
            WHERE id_laptop=?
        ");

    $stmt->bind_param(
      "sssssssssssi",
      $_POST["nombre"],
      $_POST["marca"],
      $_POST["modelo"],
      $_POST["precio"],
      $_POST["procesador"],
      $_POST["memoria_ram"],
      $_POST["almacenamiento"],
      $_POST["pantalla"],
      $_POST["estado_libreboot"],
      $_POST["descripcion"],
      $_POST["imagen_principal"],
      $id_edit
    );

    $stmt->execute();
    $stmt->close();
  }

  header("Location: crudlaptop.php");
  exit;
}

/* ============================
            ELIMINAR
============================ */
if (isset($_GET["eliminar"])) {
  $id = intval($_GET["eliminar"]);
  $mysqli->query("DELETE FROM Laptop WHERE id_laptop = $id");
}

$result = $mysqli->query("SELECT * FROM Laptop ORDER BY id_laptop DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Laptop - Tienda Linux</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #e9eef3;
      font-family: "Segoe UI", sans-serif;
    }

    .navbar {
      background: #1e293b;
    }

    .navbar-brand {
      color: #fff !important;
      font-weight: 600;
    }

    .card {
      border-radius: 12px;
      overflow: hidden;
    }

    .card-header {
      background: #0f172a;
      color: #fff;
      padding: 15px;
      font-size: 20px;
      font-weight: 600;
    }

    .btn-dark {
      background: #1e293b !important;
      border: none;
    }

    .btn-dark:hover {
      background: #0f172a !important;
    }

    table img {
      border-radius: 6px;
      box-shadow: 0px 2px 6px rgba(0, 0, 0, .2);
    }

    footer {
      margin-top: 40px;
      padding: 18px;
      background: #1e293b;
      color: #fff;
      text-align: center;
      border-top: 4px solid #334155;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-dark px-4">
    <span class="navbar-brand">💻 CRUD de Laptops — Tienda Linux</span>
  </nav>

  <div class="container mt-3">
    <a href="index.php" class="btn btn-secondary mb-3">
      ⬅️ Regresar
    </a>
  </div>

  <div class="container mt-1">

    <!-- FORMULARIO -->
    <div class="card shadow mb-4">
      <div class="card-header">
        <?= $editando ? "✏️ Editar Laptop" : "➕ Registrar Laptop" ?>
      </div>

      <div class="card-body">

        <form method="POST">
          <div class="row g-3">

            <?php foreach ($data as $campo => $valor): ?>
              <?php if ($campo !== "imagen_principal" && $campo !== "descripcion" && $campo !== "estado_libreboot"): ?>
                <div class="col-md-6">
                  <label class="form-label"><?= ucfirst(str_replace("_", " ", $campo)) ?></label>
                  <input class="form-control" type="text" name="<?= $campo ?>" value="<?= $valor ?>">
                </div>
              <?php endif; ?>
            <?php endforeach; ?>

            <div class="col-md-6">
              <label class="form-label">Libreboot</label>
              <select class="form-select" name="estado_libreboot">
                <option <?= $data["estado_libreboot"] == "Sí" ? "selected" : "" ?>>Sí</option>
                <option <?= $data["estado_libreboot"] == "No" ? "selected" : "" ?>>No</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Descripción</label>
              <textarea class="form-control" name="descripcion"><?= $data["descripcion"] ?></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label">URL Imagen Principal</label>
              <input class="form-control" type="text" name="imagen_principal" value="<?= $data["imagen_principal"] ?>">
            </div>

          </div>

          <button class="btn btn-dark mt-3" type="submit" name="guardar">
            <?= $editando ? "Guardar Cambios" : "Guardar Laptop" ?>
          </button>

          <?php if ($editando): ?>
            <a href="crudlaptop.php" class="btn btn-secondary mt-3">Cancelar</a>
          <?php endif; ?>

        </form>

      </div>
    </div>

    <!-- TABLA -->
    <div class="card shadow">
      <div class="card-header">📦 Inventario de Laptops</div>
      <div class="card-body">

        <table class="table table-striped table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Precio</th>
              <th>Libreboot</th>
              <th>Imagen</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row["id_laptop"] ?></td>
                <td><?= $row["nombre"] ?></td>
                <td><?= $row["marca"] ?></td>
                <td><?= $row["modelo"] ?></td>
                <td><strong>$<?= $row["precio"] ?></strong></td>
                <td><?= $row["estado_libreboot"] ?></td>
                <td><img src="<?= $row["imagen_principal"] ?>" width="70"></td>
                <td>
                  <a class="btn btn-warning btn-sm"
                    href="?editar=<?= $row["id_laptop"] ?>">
                    Editar
                  </a>

                  <a class="btn btn-danger btn-sm"
                    href="?eliminar=<?= $row["id_laptop"] ?>"
                    onclick="return confirm('¿Eliminar laptop?');">
                    Eliminar
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>

        </table>

      </div>
    </div>

  </div>

  <footer>
    Sistema CRUD — Tienda Linux | Libreboot Shop 🐧
  </footer>

</body>

</html>
