
<?php
require "conexion.php";

// Consultar proyectos
$sql = "SELECT id, nombre FROM proyectos
        WHERE estado = 'Activo'
        ORDER BY nombre";

$stmt = $pdo->query($sql);
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar lotes registrados
$sql = "SELECT lotes.*, proyectos.nombre AS proyecto
        FROM lotes
        INNER JOIN proyectos
        ON lotes.proyecto_id = proyectos.id
        ORDER BY lotes.id DESC";

$stmt = $pdo->query($sql);
$lotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="estilo.css">
    <title>Registro de Lotes</title>
</head>
<body>

    <h1>Registro de Lotes</h1>

    <a href="index.php">Volver al inicio</a>

    <hr>

    <h2>Agregar nuevo lote</h2>

    <form action="guardar_lote.php" method="POST">

        <label>Proyecto:</label>
        <select name="proyecto_id" required>
            <option value="">Seleccione un proyecto</option>

            <?php foreach ($proyectos as $proyecto): ?>
                <option value="<?= (int)$proyecto['id'] ?>">
                    <?= htmlspecialchars($proyecto['nombre']) ?>
                </option>
            <?php endforeach; ?>

        </select>
        <br><br>

        <label>Numero de lote:</label>
        <input type="text" name="numero_lote"
               maxlength="20" required>
        <br><br>

        <label>Area (m2):</label>
        <input type="number" name="area"
               step="0.01" min="0.01" required>
        <br><br>

        <label>Precio (Q):</label>
        <input type="number" name="precio"
               step="0.01" min="0.01" required>
        <br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Reservado">Reservado</option>
            <option value="Vendido">Vendido</option>
        </select>
        <br><br>

        <button type="submit">Guardar Lote</button>

    </form>

    <hr>

    <h2>Listado de Lotes</h2>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Proyecto</th>
            <th>Numero de Lote</th>
            <th>Area (m2)</th>
            <th>Precio (Q)</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($lotes as $lote): ?>
        <tr>
            <td><?= (int)$lote['id'] ?></td>

            <td>
                <?= htmlspecialchars($lote['proyecto']) ?>
            </td>

            <td>
                <?= htmlspecialchars($lote['numero_lote']) ?>
            </td>

            <td>
                <?= number_format($lote['area'], 2) ?>
            </td>

            <td>
                Q <?= number_format($lote['precio'], 2) ?>
            </td>

            <td>
                <?= htmlspecialchars($lote['estado']) ?>
            </td>

            <td>
                <a href="editar_lote.php?id=<?= (int)$lote['id'] ?>">
                    Editar
                </a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
