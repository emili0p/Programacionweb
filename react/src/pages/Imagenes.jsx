import React from "react";

export default function Imagenes() {
  return (
    <section>
      <h1>Imágenes de Linux</h1>
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/3/35/Tux.svg"
        alt="Tux, la mascota de Linux"
        width="200"
        style={{ marginRight: "20px" }}
      />
      <img
        src="https://upload.wikimedia.org/wikipedia/commons/6/64/Linux_kernel_map.png"
        alt="Mapa del kernel de Linux"
        width="400"
      />
    </section>
  );
}
