<?php
require "conexion.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Metodo no permitido");
}

$id = filter_input(
    INPUT_POST, 'equipo_id', FILTER_VALIDATE_INT
);
$nombre = trim($_POST['nombre'] ?? '');
$carne = trim($_POST['carne'] ?? '');
$fecha = $_POST['fecha'] ?? '';
$inicio = $_POST['hora_inicio'] ?? '';
$fin = $_POST['hora_fin'] ?? '';
$motivo = trim($_POST['motivo'] ?? '');

if (
    !$id || $nombre === '' || $carne === '' ||
    !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha) ||
    !preg_match('/^\d{2}:\d{2}$/', $inicio) ||
    !preg_match('/^\d{2}:\d{2}$/', $fin) ||
    $fin <= $inicio
) {
    exit("Datos invalidos");
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
        "SELECT id FROM equipos
         WHERE id = ? AND estado = 'Disponible'
         FOR UPDATE"
    );
    $stmt->execute([$id]);

    if (!$stmt->fetch()) {
        throw new Exception("Equipo no disponible");
    }

    $stmt = $pdo->prepare(
        "SELECT id FROM reservas
         WHERE equipo_id = ?
         AND fecha = ?
         AND hora_inicio < ?
         AND hora_fin > ?
         LIMIT 1"
    );
    $stmt->execute([$id, $fecha, $fin, $inicio]);

    if ($stmt->fetch()) {
        throw new Exception("Horario ocupado");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO reservas
         (equipo_id, nombre, carne, fecha,
          hora_inicio, hora_fin, motivo)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $id, $nombre, $carne,
        $fecha, $inicio, $fin, $motivo
    ]);

    $pdo->commit();
    echo "Reserva guardada correctamente";

} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    http_response_code(400);
    echo "No se pudo guardar la reserva: "
        . htmlspecialchars($e->getMessage());
}
?>