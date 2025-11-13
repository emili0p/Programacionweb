import React from "react";
import { Link } from "react-router-dom";

export default function NavBar() {
  return (
    <nav className="navbar">
      <Link to="/">Inicio</Link> |
      <Link to="/historia"> Historia</Link> |
      <Link to="/caracteristicas"> Características</Link> |
      <Link to="/imagenes"> Imágenes</Link> |
      <Link to="/tablas"> Tablas</Link> |
      <Link to="/formularios"> Formularios</Link> |
      <Link to="/multimedia"> Multimedia</Link>
    </nav>
  );
}
