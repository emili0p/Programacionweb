<?php
// plantilla/menu.php
// Nota: session_start() se incluye en header.php

// Estilos para la barra de navegación (NAV)
?>
<nav style="
    background: #444; /* Fondo oscuro del menú */
    padding: 12px;
    text-align: center;
">
  <?php if (isset($_SESSION['usuario'])): ?>
    <a href="logout.php" style="
            color: #ff6b81; /* Color diferente para destacar el logout */
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
            transition: color 0.3s;
        " onmouseover="this.style.color='#f5f6fa'" onmouseout="this.style.color='#ff6b81'">
      Cerrar sesión (<?php echo $_SESSION['usuario']; ?>)
    </a>
  <?php else: ?>
    <a href="login.php" style="
            color: #00b894; /* Destacar enlace a Login */
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
            transition: color 0.3s;
        " onmouseover="this.style.color='white'" onmouseout="this.style.color='#00b894'">
      Iniciar sesión
    </a>
    <a href="../registro.php" style="
            color: #00b894; /* Destacar enlace a registrarse */
            text-decoration: none;
            margin: 0 12px;
            font-weight: bold;
            transition: color 0.3s;
        " onmouseover="this.style.color='white'" onmouseout="this.style.color='#00b894'">
      registrarse
    </a>
  <?php endif; ?>


  <a href="../index.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Inicio
  </a>
  <a href="../historia.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Historia
  </a>
  <a href="../caracteristicas.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Características
  </a>
  <a href="../imagenes.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Imágenes
  </a>
  <a href="../tablas.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Tablas
  </a>
      <a href="../formularios.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Formularios
  </a>
      <a href="../multimedia.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Multimedia
  </a>

  <a href="../Tienda.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Tienda
  </a>
      <a href="PaginaLinux/pedido.php" style="
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
        transition: color 0.3s;
    " onmouseover="this.style.color='#00b894'" onmouseout="this.style.color='white'">
    Pedidos
  </a>
</nav>
