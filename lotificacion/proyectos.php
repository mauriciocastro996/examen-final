
<?php
require "conexion.php";

// Consultar proyectos registrados
$sql = "SELECT * FROM proyectos ORDER BY id DESC";

$stmt = $pdo->query($sql);

$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="estilo.css">
    <title>Registro de Proyectos</title>
</head>
<body>

    <h1>Registro de Proyectos</h1>

    <a href="index.php">Volver al inicio</a>

    <hr>

    <h2>Agregar nuevo proyecto</h2>

    <form action="guardar_proyecto.php" method="POST">

        <label>Nombre del proyecto:</label>
        <input type="text" name="nombre"
               maxlength="100" required>
        <br><br>

        <label>Ubicacion:</label>
        <input type="text" name="ubicacion"
               maxlength="150" required>
        <br><br>

        <label>Descripcion:</label>
        <textarea name="descripcion"
                  maxlength="255" rows="3"></textarea>
        <br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>
        </select>
        <br><br>

        <button type="submit">Guardar Proyecto</button>

    </form>

    <hr>

    <h2>Listado de Proyectos</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Ubicacion</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($proyectos as $proyecto): ?>
        <tr>
            <td>
                <?= (int)$proyecto['id'] ?>
            </td>

            <td>
                <?= htmlspecialchars($proyecto['nombre']) ?>
            </td>

            <td>
                <?= htmlspecialchars($proyecto['ubicacion']) ?>
            </td>

            <td>
                <?= htmlspecialchars($proyecto['descripcion'] ?? '') ?>
            </td>

            <td>
                <?= htmlspecialchars($proyecto['estado']) ?>
            </td>

            
            <td>

            <a href="editar_proyecto.php?id=<?= (int)$proyecto['id'] ?>">
                        Editar
                </a>

            <form action="eliminar_proyecto.php"
                method="POST"
                style="display:inline;">

                <input type="hidden" name="id"
               value="<?= (int)$proyecto['id'] ?>">

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
