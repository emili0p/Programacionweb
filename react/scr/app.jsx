import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import NavBar from "./components/NavBar.jsx";
import Footer from "./components/Footer.jsx";

import Home from "./pages/Home.jsx";
import Historia from "./pages/Historia.jsx";
import Caracteristicas from "./pages/Caracteristicas.jsx";
import Imagenes from "./pages/Imagenes.jsx";
import Tablas from "./pages/Tablas.jsx";
import Formulario from "./pages/Formulario.jsx";
import Multimedia from "./pages/Multimedia.jsx";

export default function App() {
  return (
    <Router>
      <div className="container">
        <NavBar />
        <main>
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
