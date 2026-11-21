
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: lotes.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$proyecto_id = filter_input(
    INPUT_POST, "proyecto_id", FILTER_VALIDATE_INT
);

$numero_lote = trim($_POST["numero_lote"] ?? "");
$area = $_POST["area"] ?? "";
$precio = $_POST["precio"] ?? "";
$estado = $_POST["estado"] ?? "";

if (
    !$id ||
    !$proyecto_id ||
    $numero_lote == "" ||
    strlen($numero_lote) > 20 ||
    !is_numeric($area) ||
    !is_numeric($precio) ||
    $area <= 0 ||
    $precio <= 0 ||
    !in_array($estado, ["Disponible", "Reservado", "Vendido"], true)
) {
    die("Datos del lote no validos.");
}

try {

    // Verificar que el proyecto exista y sea valido
    $sql = "SELECT id FROM proyectos
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => $proyecto_id]);

    if (!$stmt->fetch()) {
        die("El proyecto seleccionado no existe.");
    }

    // Actualizar lote
    $sql = "UPDATE lotes SET
            proyecto_id = :proyecto_id,
            numero_lote = :numero_lote,
            area = :area,
            precio = :precio,
            estado = :estado
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "proyecto_id" => $proyecto_id,
        "numero_lote" => $numero_lote,
        "area" => $area,
        "precio" => $precio,
        "estado" => $estado,
        "id" => $id
    ]);

    header("Location: lotes.php");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() == "23000") {
        die("Ya existe ese numero de lote en el proyecto.");
    }

    die("Error al actualizar el lote.");
}
?>
