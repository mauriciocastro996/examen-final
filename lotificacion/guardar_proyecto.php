
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: proyectos.php");
    exit;
}

$nombre = trim($_POST["nombre"] ?? "");
$ubicacion = trim($_POST["ubicacion"] ?? "");
$descripcion = trim($_POST["descripcion"] ?? "");
$estado = $_POST["estado"] ?? "";

if (
    $nombre == "" ||
    $ubicacion == "" ||
    !in_array($estado, ["Activo", "Inactivo"], true)
) {
    die("Datos del proyecto no validos.");
}

try {

    $sql = "INSERT INTO proyectos
            (nombre, ubicacion, descripcion, estado)
            VALUES
            (:nombre, :ubicacion, :descripcion, :estado)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "nombre" => $nombre,
        "ubicacion" => $ubicacion,
        "descripcion" => $descripcion,
        "estado" => $estado
    ]);

    header("Location: proyectos.php");
    exit;

} catch (PDOException $e) {

    die("Error al guardar el proyecto.");
}
?>
