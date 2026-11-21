
<?php
require "conexion.php";

// Obtener ID del lote
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID del lote no valido.");
}

// Buscar lote
$sql = "SELECT * FROM lotes WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

$lote = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lote) {
    die("Lote no encontrado.");
}

// Consultar proyectos
$sql = "SELECT id, nombre FROM proyectos
        WHERE estado = 'Activo' OR id = :proyecto_id
        ORDER BY nombre";

$stmt = $pdo->prepare($sql);
$stmt->execute(["proyecto_id" => $lote["proyecto_id"]]);

$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="estilo.css">
    <title>Editar Lote</title>
</head>
<body>

    <h1>Editar Lote</h1>

    <a href="lotes.php">Volver al listado</a>

    <hr>

    <form action="actualizar_lote.php" method="POST">

        <input type="hidden" name="id"
               value="<?= (int)$lote['id'] ?>">

        <label>Proyecto:</label>
        <select name="proyecto_id" required>

            <?php foreach ($proyectos as $proyecto): ?>

                <option value="<?= (int)$proyecto['id'] ?>"
                    <?= $proyecto['id'] == $lote['proyecto_id']
                        ? 'selected' : '' ?>>

                    <?= htmlspecialchars($proyecto['nombre']) ?>

                </option>

            <?php endforeach; ?>

        </select>
        <br><br>

        <label>Numero de lote:</label>
        <input type="text" name="numero_lote"
               maxlength="20"
               value="<?= htmlspecialchars($lote['numero_lote']) ?>"
               required>
        <br><br>

        <label>Area (m2):</label>
        <input type="number" name="area"
               step="0.01" min="0.01"
               value="<?= htmlspecialchars($lote['area']) ?>"
               required>
        <br><br>

        <label>Precio (Q):</label>
        <input type="number" name="precio"
               step="0.01" min="0.01"
               value="<?= htmlspecialchars($lote['precio']) ?>"
               required>
        <br><br>

        <label>Estado:</label>
        <select name="estado">

            <option value="Disponible"
                <?= $lote['estado'] == 'Disponible'
                    ? 'selected' : '' ?>>
                Disponible
            </option>

            <option value="Reservado"
                <?= $lote['estado'] == 'Reservado'
                    ? 'selected' : '' ?>>
                Reservado
            </option>

            <option value="Vendido"
                <?= $lote['estado'] == 'Vendido'
                    ? 'selected' : '' ?>>
                Vendido
            </option>

        </select>
        <br><br>

        <button type="submit">Actualizar Lote</button>

        <a href="lotes.php">Cancelar</a>

    </form>

</body>
</html>
