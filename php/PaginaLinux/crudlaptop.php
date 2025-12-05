<?php
/* ============================================
   CONEXIÓN A MYSQL (XAMPP Linux)
   ============================================ */
$mysqli = new mysqli("127.0.0.1", "root", "", "tiendalinux");

if ($mysqli->connect_errno) {
  die("❌ Error al conectar a MySQL: " . $mysqli->connect_error);
}

/* ============================================
   INSERTAR REGISTRO
   ============================================ */
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

/* ============================================
   ELIMINAR REGISTRO
   ============================================ */
if (isset($_GET["eliminar"])) {
  $id = intval($_GET["eliminar"]);
  $mysqli->query("DELETE FROM Laptop WHERE id_laptop = $id");
}

/* ============================================
   CONSULTA
   ============================================ */
$result = $mysqli->query("SELECT * FROM Laptop ORDER BY id_laptop DESC");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Laptop - Tienda Linux</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f2f5f7;
    }

    .container {
      margin-top: 40px;
    }

    .card-header {
      background: #212529;
      color: white;
      font-size: 20px;
    }

    footer {
      margin-top: 40px;
      padding: 20px;
      background: #212529;
      color: #fff;
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="container">

    <!-- FORMULARIO -->
    <div class="card shadow">
      <div class="card-header">Registrar Laptop</div>
      <div class="card-body">

        <form method="POST">
          <div class="row">

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
              <label class="form-label">Precio</label>
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
    <div class="card shadow mt-4">
      <div class="card-header">Inventario de Laptops</div>
      <div class="card-body">

        <table class="table table-striped table-hover">
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
                <td>$<?= $row["precio"] ?></td>
                <td><?= $row["estado_libreboot"] ?></td>
                <td><img src="<?= $row["imagen_principal"] ?>" width="60"></td>

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
    Sistema CRUD — Tienda Linux | Libreboot Shop
  </footer>

</body>

</html>
