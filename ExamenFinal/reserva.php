<?php
require "conexion.php";

$equipos = $pdo->query(
    "SELECT id, codigo, nombre
     FROM equipos
     WHERE estado = 'Disponible'"
)->fetchAll(PDO::FETCH_ASSOC);

$seleccionado = filter_input(
    INPUT_GET, 'equipo_id', FILTER_VALIDATE_INT
);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1">
<title>Registrar Nueva Reserva</title>

</head>
<body>

<form action="guardar.php" method="POST">
<h2>Registro de Reseraa</h2>

<label>Nombre completo: </label>
<input type="text" name="nombre" required>
<br>
<label>Carnet: </label>
<input type="text" name="carne" required>
<br>
<label>Equipo</label>
<select name="equipo_id" required>
<option value="">Seleccione un equipo</option>
<?php foreach ($equipos as $equipo): ?>
<option value="<?= $equipo['id'] ?>"
<?= $seleccionado == $equipo['id']
    ? 'selected' : '' ?>>
<?= htmlspecialchars(
    $equipo['codigo'] . ' - ' . $equipo['nombre']
) ?>
</option>
<?php endforeach; ?>
</select>

<label>Fecha</label>
<input type="date" name="fecha" required>
<br>
<label>Hora inicio</label>
<input type="time" name="hora_inicio" required>
<br>
<label>Hora fin</label>
<input type="time" name="hora_fin" required>
<br>
<label>Motivo</label>
<textarea name="motivo"></textarea>
<br>
<button type="submit">Guardar reserva</button>
<a href="index.php">Cancelar</a>
</form>

</body>
</html>