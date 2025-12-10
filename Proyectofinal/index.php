<?php
// index.php
include "plantilla/header.php";
include "plantilla/menu.php";   // El menú ya no necesita targets

// --- Contenido específico de la página de INICIO ---
?>
<main>
  <div style="text-align:center;">
    <h2 style='color:#00b894;'>Bienvenido a mi proyecto sobre Linux</h2>
    <p style='max-width:800px; margin:20px auto; text-align:justify;'>
      Este sitio explora la historia, características y ventajas de Linux, un sistema operativo libre y de código abierto que impulsa millones de servidores, computadoras y dispositivos en todo el mundo.
    </p>
    <p>Usa el menú superior para navegar entre las secciones.</p>
    <img src='https://upload.wikimedia.org/wikipedia/commons/3/35/Tux.svg'
      alt='Logo de Linux (Tux)' width='200' style='display:block; margin:20px auto;'>
  </div>
</main>
<?php
// --- Fin del contenido ---
include "plantilla/footer.php";
?>
