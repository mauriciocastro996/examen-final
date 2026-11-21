
<?php
require "conexion.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID de cliente no valido.");
}

$sql = "SELECT * FROM clientes WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(["id" => $id]);

$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css">
    <title>Edicion de clientes</title>
</head>
<body>

<h1>Editar Cliente</h1>

<form action="actualizar_cliente.php" method="POST">

    <input type="hidden" name="id"
           value="<?= (int)$cliente['id'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre"
           value="<?= htmlspecialchars($cliente['nombre']) ?>"
           required>
    <br><br>

    <label>Apellido:</label>
    <input type="text" name="apellido"
           value="<?= htmlspecialchars($cliente['apellido']) ?>"
           required>
    <br><br>

    <label>DPI:</label>
    <input type="text" name="dpi"
           value="<?= htmlspecialchars($cliente['dpi']) ?>"
           minlength="13" maxlength="13"
           pattern="[0-9]{13}" required>
    <br><br>

    <label>Telefono:</label>
    <input type="text" name="telefono"
           value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>">
    <br><br>

    <label>Direccion:</label>
    <input type="text" name="direccion"
           value="<?= htmlspecialchars($cliente['direccion'] ?? '') ?>">
    <br><br>

    <button type="submit">Actualizar Cliente</button>
    <a href="clientes.php">Cancelar</a>

</form>

</body>
</html>
