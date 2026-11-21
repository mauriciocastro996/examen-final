
<?php
require "conexion.php";

// Consultar clientes registrados
$sql = "SELECT * FROM clientes ORDER BY id DESC";
$stmt = $pdo->query($sql);
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="estilo.css">
    <title>Registro de Clientes</title>
</head>
<body>

    <h1>Registro de Clientes</h1>

    <a href="index.php">Volver al inicio</a>

    <hr>

    <h2>Agregar nuevo cliente</h2>

    <form action="guardar_cliente.php" method="POST">

        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <br><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" required>
        <br><br>

        <label>DPI:</label>
        <input type="text" name="dpi"
               maxlength="13" minlength="13"
               pattern="[0-9]{13}" required>
        <br><br>

        <label>Telefono:</label>
        <input type="text" name="telefono">
        <br><br>

        <label>Direccion:</label>
        <input type="text" name="direccion">
        <br><br>

        <button type="submit">Guardar Cliente</button>

    </form>

    <hr>

    <h2>Listado de Clientes</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DPI</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($clientes as $cliente): ?>
        <tr>
            <td>
                <?= (int)$cliente['id'] ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente['nombre']) ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente['apellido']) ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente['dpi']) ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente['telefono'] ?? '') ?>
            </td>

            <td>
                <?= htmlspecialchars($cliente['direccion'] ?? '') ?>
            </td>

         
<td>

    <a href="editar_cliente.php?id=<?= (int)$cliente['id'] ?>">
        Editar
    </a>

    <form action="eliminar_cliente.php"
          method="POST"
          style="display:inline;">

        <input type="hidden" name="id"
               value="<?= (int)$cliente['id'] ?>">

        <button type="submit">
            Eliminar
        </button>

    </form>

</td>


        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
