import React from "react";

export default function Formulario() {
  return (
    <section>
      <h1>Encuesta sobre Linux</h1>
      <form>
        <label>Nombre: <input type="text" name="nombre" /></label><br /><br />
        <label>Email: <input type="email" name="email" /></label><br /><br />
        <label>Distribución favorita: <input type="text" name="distro" /></label><br /><br />
        <label>Comentarios: <br /><textarea name="comentarios" rows="4" cols="40"></textarea></label><br /><br />
        <input type="submit" value="Enviar" />
      </form>
    </section>
  );
}
