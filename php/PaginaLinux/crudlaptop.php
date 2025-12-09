<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "tiendalinux");
if ($mysqli->connect_errno) {
  die("❌ Error al conectar a MySQL: " . $mysqli->connect_error);
}

if (isset($_POST["insertar"])) {
  $stmt = $mysqli->prepare("INSERT INTO Laptop 
        (nombre, marca, modelo, precio, procesador, memoria_ram, almacenamiento, pantalla, estado_libreboot, descripcion, imagen_principal)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
}

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
      letter-spacing: 0.5px;
    }

    .card {
      border-radius: 12px;
      overflow: hidden;
    }

    .card-header {
      background: #0f172a;
      color: #fff;
      padding: 15px 20px;
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
      box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
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

  <!-- NAVBAR -->
  <nav class="navbar navbar-dark px-4">
    <span class="navbar-brand">💻 CRUD de Laptops — Tienda Linux</span>
  </nav>

  <!-- BOTÓN REGRESAR -->
  <div class="container mt-3">
    <a href="index.php" class="btn btn-secondary mb-3">
      ⬅️ Regresar
    </a>
  </div>

  <div class="container mt-1">

    <!-- FORMULARIO -->
    <div class="card shadow mb-4">
      <div class="card-header">➕ Registrar Laptop</div>
      <div class="card-body">

        <form method="POST">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input class="form-control" type="text" name="nombre" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Marca</label>
              <input class="form-control" type="text" name="marca" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Modelo</label>
              <input class="form-control" type="text" name="modelo" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Precio (MXN)</label>
              <input class="form-control" type="number" name="precio" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Procesador</label>
              <input class="form-control" type="text" name="procesador">
            </div>

            <div class="col-md-6">
              <label class="form-label">Memoria RAM</label>
              <input class="form-control" type="text" name="memoria_ram">
            </div>

            <div class="col-md-6">
              <label class="form-label">Almacenamiento</label>
              <input class="form-control" type="text" name="almacenamiento">
            </div>

            <div class="col-md-6">
              <label class="form-label">Pantalla</label>
              <input class="form-control" type="text" name="pantalla">
            </div>

            <div class="col-md-6">
              <label class="form-label">Libreboot</label>
              <select class="form-select" name="estado_libreboot">
                <option value="Sí">Sí</option>
                <option value="No">No</option>
              </select>
            </div>

            <div class="col-md-12">
              <label class="form-label">Descripción</label>
              <textarea class="form-control" name="descripcion"></textarea>
            </div>

            <div class="col-md-12">
              <label class="form-label">URL Imagen Principal</label>
              <input class="form-control" type="text" name="imagen_principal">
            </div>

          </div>

          <button class="btn btn-dark mt-3" type="submit" name="insertar">
            Guardar Laptop
          </button>
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
