<?php // Dentro de plantilla/menu.php 
?>

<nav>
    <?php if (isset($_SESSION['usuario'])): ?>
        <a href="logout.php">Cerrar sesión (<?php echo $_SESSION['usuario']; ?>)</a>
      <?php else: ?>
        <a href="login.php">Iniciar sesión</a>
      <?php endif; ?>

    <a href="index.php">Inicio</a>
    <a href="historia.php">Historia</a>
    <a href="caracteristicas.php">Características</a>
    <a href="imagenes.php">Imágenes</a>
    <a href="tablas.php">Tablas</a>
    <a href="formularios.php">Formularios</a>
    <a href="multimedia.php">Multimedia</a>

    <a href="PaginaLinux/index.php">Tienda</a>
    <a href="PaginaLinux/pedido.php">Pedidos</a>
</nav>
