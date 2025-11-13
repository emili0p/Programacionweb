import React from "react";
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";
import Footer from "./components/Footer";

// Páginas
import Home from "./pages/Home";
import Historia from "./pages/Historia";
import Caracteristicas from "./pages/Caracteristicas";
import Imagenes from "./pages/Imagenes";
import Tablas from "./pages/Tablas";
import Formulario from "./pages/Formulario";
import Multimedia from "./pages/Multimedia";

function App() {
  const linkStyle = { margin: "0 10px", color: "#61dafb", textDecoration: "none" };

  return (
    <Router>
      <div style={{ fontFamily: "Arial, sans-serif", textAlign: "center" }}>
        <header style={{ backgroundColor: "#222", color: "#fff", padding: "1rem" }}>
          <h1>Linux: El poder del software libre</h1>
          <nav style={{ marginTop: "1rem" }}>
            <Link to="/" style={linkStyle}>Inicio</Link>
            <Link to="/historia" style={linkStyle}>Historia</Link>
            <Link to="/caracteristicas" style={linkStyle}>Características</Link>
            <Link to="/imagenes" style={linkStyle}>Imágenes</Link>
            <Link to="/tablas" style={linkStyle}>Tablas</Link>
            <Link to="/formularios" style={linkStyle}>Formularios</Link>
            <Link to="/multimedia" style={linkStyle}>Multimedia</Link>
          </nav>
        </header>

        <main style={{ padding: "2rem" }}>
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/historia" element={<Historia />} />
            <Route path="/caracteristicas" element={<Caracteristicas />} />
            <Route path="/imagenes" element={<Imagenes />} />
            <Route path="/tablas" element={<Tablas />} />
            <Route path="/formularios" element={<Formulario />} />
            <Route path="/multimedia" element={<Multimedia />} />
          </Routes>
        </main>

        <Footer />
      </div>
    </Router>
  );
}

export default App;
