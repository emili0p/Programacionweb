<?php
session_start(); // <-- NECESARIO
?>

<nav>
  <?php if (isset($_SESSION['usuario'])): ?>
    <a href="/logout.php">Cerrar sesión (<?php echo $_SESSION['usuario']; ?>)</a>
  <?php else: ?>
    <a href="/login.php">Iniciar sesión</a>
  <?php endif; ?>

  <a href="/index.php" target="contenido">Inicio</a>
  <a href="/historia.php" target="contenido">Historia</a>
  <a href="/caracteristicas.php" target="contenido">Características</a>
  <a href="/imagenes.php" target="contenido">Imágenes</a>
  <a href="/tablas.php" target="contenido">Tablas</a>
  <a href="/formularios.php" target="contenido">Formularios</a>
  <a href="/multimedia.php" target="contenido">Multimedia</a>

  <!-- Tienda -->
  <a href="/PaginaLinux/index.php" target="contenido">Tienda</a>
  <a href="/PaginaLinux/pedido.php" target="contenido">Pedidos</a>
</nav>
