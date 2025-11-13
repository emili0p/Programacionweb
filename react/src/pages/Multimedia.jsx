import React from "react";

export default function Multimedia() {
  return (
    <section>
      <h1>Multimedia en Linux</h1>
      <p>
        Linux cuenta con soporte para múltiples formatos de audio y video, 
        además de reproductores populares como VLC, MPV y Audacious.
      </p>
      <video width="400" controls>
        <source src="https://samplelib.com/lib/preview/mp4/sample-5s.mp4" type="video/mp4" />
        Tu navegador no soporta video HTML5.
      </video>
      <br /><br />
      <audio controls>
        <source src="https://samplelib.com/lib/preview/mp3/sample-3s.mp3" type="audio/mp3" />
        Tu navegador no soporta audio HTML5.
      </audio>
    </section>
  );
}
