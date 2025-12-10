<?php include "plantilla/header.php"; ?>
<?php include "plantilla/menu.php"; ?>

<main style="display:flex; justify-content:center; align-items:center; height:70vh;">
  <form action="validarLogin.php" method="POST"
    style="background:white; padding:30px; border-radius:10px; box-shadow:0 4px 8px rgba(0,0,0,0.1); width:350px;">
    <h2 style="text-align:center; color:#00b894;">Iniciar Sesión</h2>

    <label>Usuario:</label>
    <input type="text" name="usuario" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <label>Contraseña:</label>
    <input type="password" name="password" required
      style="width:100%; padding:10px; margin:10px 0; border-radius:5px; border:1px solid #ccc;">

    <button type="submit"
      style="width:100%; padding:10px; background:#00b894; color:white; border:none; border-radius:5px; cursor:pointer;">
      Entrar
    </button>
  </form>
</main>

<?php include "plantilla/footer.php"; ?>
