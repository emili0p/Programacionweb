import React from "react";

export default function Tablas() {
  return (
    <section>
      <h1>Comparación de distribuciones de Linux</h1>
      <p style={{ fontSize: "0.9rem", color: "#555" }}>
        Tabla comparativa con datos útiles para escoger una distribución según experiencia, uso y gestión de paquetes.
      </p>

      <div style={{ overflowX: "auto" }}>
        <table style={{ borderCollapse: "collapse", width: "100%", minWidth: "900px" }}>
          <thead>
            <tr style={{ background: "#f2f2f2" }}>
              <th>Distro</th>
              <th>Año (aprox.)</th>
              <th>Base</th>
              <th>Gestor de paquetes</th>
              <th>Modelo de lanzamiento</th>
              <th>Entorno(s)</th>
              <th>Dificultad</th>
              <th>Uso principal</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>Ubuntu</td><td>2004</td><td>Debian</td><td>APT / dpkg</td><td>LTS + regulares</td><td>GNOME</td><td>Principiante</td><td>Escritorio, servidores</td></tr>
            <tr><td>Debian</td><td>1993</td><td>Independiente</td><td>APT / dpkg</td><td>Estable</td><td>GNOME, XFCE</td><td>Todos</td><td>Servidores, base</td></tr>
            <tr><td>Fedora</td><td>2003</td><td>Red Hat</td><td>dnf / rpm</td><td>Semestral</td><td>GNOME</td><td>Intermedio</td><td>Desarrollo</td></tr>
            <tr><td>Arch Linux</td><td>2002</td><td>Independiente</td><td>pacman</td><td>Rolling release</td><td>Libre</td><td>Avanzado</td><td>Control total</td></tr>
            <tr><td>Manjaro</td><td>2011</td><td>Arch</td><td>pacman + pamac</td><td>Semi-rolling</td><td>XFCE, KDE</td><td>Intermedio</td><td>Escritorio</td></tr>
            <tr><td>openSUSE</td><td>2005</td><td>SUSE</td><td>zypper / rpm</td><td>Leap / Tumbleweed</td><td>KDE, GNOME</td><td>Intermedio</td><td>Servidores</td></tr>
            <tr><td>AlmaLinux / Rocky</td><td>2021</td><td>RHEL</td><td>dnf / rpm</td><td>Estable</td><td>GNOME</td><td>Intermedio</td><td>Empresas</td></tr>
          </tbody>
        </table>
      </div>
    </section>
  );
}
