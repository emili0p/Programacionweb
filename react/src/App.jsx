import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Footer from "./components/Footer";
import NavBar from "./components/NavBar";
// Páginas
import Home from "./pages/Home";
import Historia from "./pages/Historia";
import Caracteristicas from "./pages/Caracteristicas";
import Imagenes from "./pages/Imagenes";
import Tablas from "./pages/Tablas";
import Formulario from "./pages/Formulario";
import Multimedia from "./pages/Multimedia";

function App() {
  return (
    <Router>
      <div style={{ fontFamily: "Arial, sans-serif", textAlign: "center" }}>
        <header style={{ backgroundColor: "#222", color: "#fff", padding: "1rem" }}>
          <h1>Linux: El poder del software libre</h1>
          <NavBar />
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

