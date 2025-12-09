<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Gestión de Proyectos</title>

  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: #eef1f5;
      color: #333;
    }

    header {
      background: #1e293b;
      padding: 20px;
      text-align: center;
      color: white;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    h1 {
      margin: 0;
      font-size: 32px;
      font-weight: 600;
    }

    p.subtitle {
      margin-top: 5px;
      font-size: 16px;
      opacity: .8;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 0 20px;
    }

    .card {
      background: white;
      padding: 25px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: transform .2s, box-shadow .2s;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
    }

    .card a {
      display: inline-block;
      margin-top: 15px;
      background: #3b82f6;
      color: white;
      padding: 10px 18px;
      text-decoration: none;
      font-size: 16px;
      border-radius: 8px;
      transition: background .2s;
    }

    .card a:hover {
      background: #1d4ed8;
    }

    footer {
      margin-top: 40px;
      text-align: center;
      padding: 20px;
      color: #555;
      font-size: 14px;
    }
  </style>

</head>


<body>

  <header>
    <h1>Gestión de Proyectos</h1>
    <p class="subtitle">Panel de administración · Sistema CRUD</p>
  </header>


  <div class="container">

    <div class="card">
      <h2>CRUD de Laptops</h2>
      <p>Gestiona las laptops disponibles en la tienda.</p>
      <a href="crudlaptop.php">Entrar</a>
    </div>

    <div class="card">
      <h2>Distribuciones Linux</h2>
      <p>Administra las distros Linux compatibles.</p>
      <a href="crudDistro.php">Entrar</a>
    </div>

    <div class="card">
      <h2>Compatibilidad</h2>
      <p>Asocia laptops con distribuciones.</p>
      <a href="crudCompatibilidad.php">Entrar</a>
    </div>

    <div class="card">
      <h2>Pedidos</h2>
      <p>Registra y actualiza los pedidos de clientes.</p>
      <a href="pedido.php">Entrar</a>
    </div>

    <div class="card">
      <h2>Usuarios</h2>
      <p>Gestión de clientes registrados.</p>
      <a href="usuariocrud.php">Entrar</a>
    </div>

  </div>


  <footer>
    © 2025 – Panel de Gestión de Proyectos · Proyecto Escolar
  </footer>

</body>

</html>
