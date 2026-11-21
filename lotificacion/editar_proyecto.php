
<?php
require "conexion.php";

// Obtener el ID del proyecto
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID del proyecto no valido.");
}

// Buscar el proyecto
$sql = "SELECT * FROM proyectos WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

$proyecto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$proyecto) {
    die("Proyecto no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="estilo.css">
    <title>Editar Proyecto</title>
</head>
<body>

    <h1>Editar Proyecto</h1>

    <form action="actualizar_proyecto.php" method="POST">

        <input type="hidden" name="id"
               value="<?= (int)$proyecto['id'] ?>">

        <label>Nombre del proyecto:</label>
        <input type="text" name="nombre"
               maxlength="100"
               value="<?= htmlspecialchars($proyecto['nombre']) ?>"
               required>
        <br><br>

        <label>Ubicacion:</label>
        <input type="text" name="ubicacion"
               maxlength="150"
               value="<?= htmlspecialchars($proyecto['ubicacion']) ?>"
               required>
        <br><br>

        <label>Descripcion:</label>
        <textarea name="descripcion"
                  maxlength="255" rows="3"><?= htmlspecialchars($proyecto['descripcion'] ?? '') ?></textarea>
        <br><br>

        <label>Estado:</label>
        <select name="estado">
            <option value="Activo"
                <?= $proyecto['estado'] == "Activo" ? "selected" : "" ?>>
                Activo
            </option>

            <option value="Inactivo"
                <?= $proyecto['estado'] == "Inactivo" ? "selected" : "" ?>>
                Inactivo
            </option>
        </select>
        <br><br>

        <button type="submit">Actualizar Proyecto</button>

        <a href="proyectos.php">Cancelar</a>

    </form>

</body>
</html>
