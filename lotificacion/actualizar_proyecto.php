
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: proyectos.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nombre = trim($_POST["nombre"] ?? "");
$ubicacion = trim($_POST["ubicacion"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");
$estado = $_POST["estado"] ?? "";

if (
    !$id ||
    $nombre == "" ||
    $ubicacion == "" ||
    !in_array($estado, ["Activo", "Inactivo"], true)
) {
    die("Datos del proyecto no validos.");
}

try {

    $sql = "UPDATE proyectos SET
            nombre = :nombre,
            ubicacion = :ubicacion,
            descripcion = :descripcion,
            estado = :estado
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "nombre" => $nombre,
        "ubicacion" => $ubicacion,
        "descripcion" => $descripcion,
        "estado" => $estado,
        "id" => $id
    ]);

    header("Location: proyectos.php");
    exit;

} catch (PDOException $e) {

    die("Error al actualizar el proyecto.");
}
?>
