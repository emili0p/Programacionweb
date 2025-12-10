<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Proyecto Final</title>
  <style>
    body {
      font-family: "Segoe UI", Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f7fa;
      color: #333;
    }

    header {
      background: #222;
      color: white;
      text-align: center;
      padding: 30px 20px;
    }

    header h1 {
      margin: 0;
      font-size: 2em;
    }

    /* Menú */
    nav {
      background: #444;
      padding: 12px;
      text-align: center;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 12px;
      font-weight: bold;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #00b894;
    }

    /* Contenedor del iframe */
    main {
      display: flex;
      justify-content: center;
      margin: 0;
      padding: 0;
    }

    iframe {
      width: 100%;
      max-width: 1000px;
      height: 80vh;
      border: none;
      background: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      margin: 20px;
    }

    footer {
      background: #222;
      color: white;
      text-align: center;
      padding: 15px;
    }
  </style>
</head>

<body>
  <header>
    <h1>Linux: El poder del software libre</h1>
  </header>

  <nav>
    <a href="index.php" target="contenido">Inicio</a>
    <a href="historia.php" target="contenido">Historia</a>
    <a href="caracteristicas.php" target="contenido">Características</a>
    <a href="imagenes.php" target="contenido">Imágenes</a>
    <a href="tablas.php" target="contenido">Tablas</a>
    <a href="formularios.php" target="contenido">Formularios</a>
    <a href="multimedia.php" target="contenido">Multimedia</a>

    <!-- Aquí ya integras la tienda -->
    <a href="PaginaLinux/index.php" target="contenido">Tienda</a>
    <a href="PaginaLinux/pedido.php" target="contenido">Pedidos</a>
  </nav>

  <main>
    <!-- Muestra el contenido principal (index) por defecto -->
    <iframe name="contenido" srcdoc="
            <h2 style='text-align:center; color:#00b894;'>Bienvenido a mi proyecto sobre Linux</h2>
            <p style='max-width:800px; margin:20px auto; text-align:justify;'>
                Este sitio explora la historia, características y ventajas de Linux, 
                un sistema operativo libre y de código abierto que impulsa millones de servidores, 
                computadoras y dispositivos en todo el mundo.
            </p>
            <p style='text-align:center;'>Usa el menú superior para navegar entre las secciones.</p>
            <img src='https://upload.wikimedia.org/wikipedia/commons/3/35/Tux.svg' 
                 alt='Logo de Linux (Tux)' width='200' style='display:block; margin:20px auto;'>
        "></iframe>
  </main>

  <footer>
    &copy; 2025 - Proyecto Linux | Desarrollado para práctica HTML
  </footer>
</body>

</html>
