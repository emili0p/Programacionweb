<h1 style="
    font-family: system-ui, -apple-system, 'Segoe UI', Roboto, Arial;
    margin-bottom: 20px;
">
  Encuesta sobre Linux
</h1>

<form action="#" method="post" style="
    max-width:600px;
    padding:25px;
    border:1px solid #ddd;
    border-radius:8px;
    background:#fff;
    box-shadow:0 4px 8px rgba(0,0,0,0.05);
    font-family:system-ui, -apple-system, 'Segoe UI', Roboto, Arial;
">

  <label style="display:block; margin-bottom:12px; font-weight:500;">
    Nombre:
    <input type="text" name="nombre" placeholder="Escribe tu nombre" required
      style="width:100%; padding:8px; margin-top:4px; border:1px solid #ccc; border-radius:4px;">
  </label>

  <label style="display:block; margin-bottom:12px; font-weight:500;">
    Email:
    <input type="email" name="email" placeholder="ejemplo@correo.com" required
      style="width:100%; padding:8px; margin-top:4px; border:1px solid #ccc; border-radius:4px;">
  </label>

  <label style="display:block; margin-bottom:12px; font-weight:500;">
    ¿Qué distribución usas actualmente?
    <select name="distro" required
      style="width:100%; padding:8px; margin-top:4px; border:1px solid #ccc; border-radius:4px;">
      <option value="">--Selecciona--</option>
      <option value="ubuntu">Ubuntu</option>
      <option value="debian">Debian</option>
      <option value="arch">Arch Linux</option>
      <option value="fedora">Fedora</option>
      <option value="opensuse">openSUSE</option>
      <option value="otra">Otra</option>
    </select>
  </label>

  <label style="display:block; margin-bottom:8px; font-weight:500;">
    ¿Qué tipo de usuario te consideras?
  </label>

  <label><input type="radio" name="nivel" value="principiante" required> Principiante</label><br>
  <label><input type="radio" name="nivel" value="intermedio"> Intermedio</label><br>
  <label><input type="radio" name="nivel" value="avanzado"> Avanzado</label><br><br>

  <label style="display:block; margin-bottom:8px; font-weight:500;">
    ¿Para qué usas Linux? (puedes elegir varias opciones)
  </label>

  <label><input type="checkbox" name="uso[]" value="estudio"> Estudio</label><br>
  <label><input type="checkbox" name="uso[]" value="trabajo"> Trabajo</label><br>
  <label><input type="checkbox" name="uso[]" value="servidores"> Servidores</label><br>
  <label><input type="checkbox" name="uso[]" value="juegos"> Juegos</label><br>
  <label><input type="checkbox" name="uso[]" value="otro"> Otro</label><br><br>

  <label style="display:block; margin-bottom:12px; font-weight:500;">
    Comentarios:
    <textarea name="comentarios" rows="4" placeholder="Comparte tu opinión sobre Linux..."
      style="width:100%; padding:8px; margin-top:4px; border:1px solid #ccc; border-radius:4px;"></textarea>
  </label>

  <input type="submit" value="Enviar" style="
        width:auto;
        padding:10px 20px;
        background:#4CAF50;
        color:white;
        border:none;
        border-radius:4px;
        cursor:pointer;
        font-weight:bold;
        transition:background 0.3s;
    "
    onmouseover="this.style.background='#43a047'"
    onmouseout="this.style.background='#4CAF50'">

</form>
