import React from "react";

export default function Home() {
  return (
    <section>
      <h1>Linux: El poder del software libre</h1>
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/3/35/Tux.svg"
        alt="Logo de Linux (Tux)"
        width="200"
      />
      <p>
        Linux es un sistema operativo de código abierto basado en Unix. 
        Fue creado en 1991 por Linus Torvalds y desde entonces ha crecido 
        hasta convertirse en la base de numerosos sistemas y dispositivos en todo el mundo.
      </p>
      <h2>Razones para usar Linux</h2>
      <ol>
        <li>Es gratuito y de código abierto.</li>
        <li>Ofrece gran seguridad y estabilidad.</li>
        <li>Cuenta con una amplia comunidad de soporte.</li>
        <li>Se adapta a todo tipo de dispositivos.</li>
        <li>Proporciona control y personalización total.</li>
      </ol>
    </section>
  );
}
