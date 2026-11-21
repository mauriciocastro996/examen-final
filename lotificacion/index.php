
<?php
require "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Lotificacion Las Marias</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <header>
        <h1>Lotificacion Las Marias</h1>
        <p>Sistema de control de lotes y financiamientos</p>
    </header>

    <div class="contenedor">

        <h2>Menu principal</h2>
        <p>Seleccione una opcion del sistema.</p>

        <div class="menu">

            <a href="clientes.php">
                Registro de clientes
            </a>
            <br>

            <a href="proyectos.php">
                Registro de proyectos
            </a>
            <br>

            <a href="lotes.php">
                Control de lotes
            </a>
        </div>

    </div>

    <footer>
        <p>Lotificacion Las Marias Guatemala</p>
    </footer>

</body>
</html>
