<?php
include "plantilla/header.php";
include "plantilla/menu.php";
?>

<main style="display:flex; justify-content:center; align-items:center;">
  <form action="PaginaLinux/usuariocrud.php" method="POST"
    style="background:white; padding:30px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1); width:450px; margin: 20px 0;">

    <h2 style="text-align:center; color:#00b894;">Registro de Usuario</h2>
    <input type="hidden" name="accion" value="registrar">

    <label>Nombre de Usuario:</label>
    <input type="text" name="nombre" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <label>Correo Electrónico:</label>
    <input type="email" name="correo" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <label>Teléfono (10 dígitos):</label>
    <input type="text" name="telefono" pattern="[0-9]{10}" title="Debe contener 10 dígitos numéricos" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <label>Contraseña:</label>
    <input type="password" name="password" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <button type="submit"
      style="width:100%; padding:10px; background:#00b894; color:white; border:none; border-radius:5px; cursor:pointer;">
      Registrarse
    </button>
  </form>
</main>

<?php include "plantilla/footer.php"; ?>
