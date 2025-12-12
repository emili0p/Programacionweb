<?php
// usuariocrud.php — versión robusta para registro + CRUD
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "tiendalinux";

$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
  die("Error en la conexión: " . $conexion->connect_error);
}

// For debugging quick check: uncomment to see incoming data
// var_dump($_SERVER['REQUEST_METHOD'], $_POST, $_GET);

// --- Registro desde el formulario (login/registro) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'registrar') {
  $nombre   = trim($_POST['nombre'] ?? '');
  $correo   = trim($_POST['correo'] ?? '');
  $telefono = trim($_POST['telefono'] ?? '');
  $password = $_POST['password'] ?? '';

  // Validaciones mínimas
  if ($nombre === '' || $correo === '' || $telefono === '' || $password === '') {
    echo "<script>alert('Por favor completa todos los campos.'); window.history.back();</script>";
    exit;
  }

  // Evitar registros duplicados por correo
  $stmt = $conexion->prepare("SELECT id_usuario FROM Usuario WHERE correo = ?");
  $stmt->bind_param("s", $correo);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $stmt->close();
    echo "<script>alert('Ya existe un usuario con ese correo.'); window.location='login.php';</script>";
    exit;
  }
  $stmt->close();

  // Insert con password hash
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $conexion->prepare("INSERT INTO Usuario (nombre, correo, telefono, password) VALUES (?, ?, ?, ?)");
  if (!$stmt) {
    die("Error al preparar INSERT: " . $conexion->error);
  }
  $stmt->bind_param("ssss", $nombre, $correo, $telefono, $hash);

  if ($stmt->execute()) {
    $stmt->close();
    // Registro correcto: redirigir a login
    echo "<script>alert('Registro exitoso. Inicia sesión.'); window.location='login.php';</script>";
    exit;
  } else {
    $err = $stmt->error;
    $stmt->close();
    die("Error al insertar usuario: " . $err);
  }
}

// --- CRUD tradicional (botones del administrador) ---
// Crear (botón name="crear")
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear'])) {
  $nombre   = trim($_POST['nombre'] ?? '');
  $correo   = trim($_POST['correo'] ?? '');
  $telefono = trim($_POST['telefono'] ?? '');

  $stmt = $conexion->prepare("INSERT INTO Usuario (nombre, correo, telefono) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nombre, $correo, $telefono);
  $stmt->execute();
  $stmt->close();
  header("Location: usuariocrud.php");
  exit;
}

// Actualizar (botón name="actualizar")
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
  $id       = intval($_POST['id_usuario'] ?? 0);
  $nombre   = trim($_POST['nombre'] ?? '');
  $correo   = trim($_POST['correo'] ?? '');
  $telefono = trim($_POST['telefono'] ?? '');

  $stmt = $conexion->prepare("UPDATE Usuario SET nombre=?, correo=?, telefono=? WHERE id_usuario=?");
  $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
  $stmt->execute();
  $stmt->close();
  header("Location: usuariocrud.php");
  exit;
}

// Eliminar (GET ?eliminar=ID)
if (isset($_GET['eliminar'])) {
  $id = intval($_GET['eliminar']);
  $stmt = $conexion->prepare("DELETE FROM Usuario WHERE id_usuario=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
  header("Location: usuariocrud.php");
  exit;
}

// Obtener editar
$editando = null;
if (isset($_GET['editar'])) {
  $id_edit = intval($_GET['editar']);
  $stmt = $conexion->prepare("SELECT id_usuario, nombre, correo, telefono FROM Usuario WHERE id_usuario = ?");
  $stmt->bind_param("i", $id_edit);
  $stmt->execute();
  $res = $stmt->get_result();
  $editando = $res->fetch_assoc();
  $stmt->close();
}

// Consultar todos
$resultado = $conexion->query("SELECT id_usuario, nombre, correo, telefono FROM Usuario ORDER BY id_usuario ASC");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>CRUD Usuarios</title>
  <style>
    /* (mantén tus estilos) */
    body {
      font-family: Arial, sans-serif;
      background: #eef1f5;
      padding: 20px;
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

    <form class="formulario" method="POST" action="usuariocrud.php">

      <?php if ($editando): ?>
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($editando['id_usuario']) ?>">
      <?php endif; ?>

      <label>Nombre:</label><br>
      <input type="text" name="nombre" required value="<?= htmlspecialchars($editando['nombre'] ?? '') ?>"><br>

      <label>Correo:</label><br>
      <input type="email" name="correo" required value="<?= htmlspecialchars($editando['correo'] ?? '') ?>"><br>

      <label>Teléfono:</label><br>
      <input type="text" name="telefono" required value="<?= htmlspecialchars($editando['telefono'] ?? '') ?>"><br>

      <?php if ($editando): ?>
        <button type="submit" name="actualizar">Actualizar</button>
      <?php else: ?>
        <button type="submit" name="crear">Crear</button>
      <?php endif; ?>
    </form>

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
          <td><?= htmlspecialchars($fila['id_usuario']) ?></td>
          <td><?= htmlspecialchars($fila['nombre']) ?></td>
          <td><?= htmlspecialchars($fila['correo']) ?></td>
          <td><?= htmlspecialchars($fila['telefono']) ?></td>
          <td>
            <a class="btn btn-editar" href="?editar=<?= $fila['id_usuario'] ?>">Editar</a>
            <a class="btn btn-eliminar" href="?eliminar=<?= $fila['id_usuario'] ?>" onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>

    </table>

  </div>

</body>

</html>
