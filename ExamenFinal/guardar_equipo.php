
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: agregar_equipo.php");
    exit;
}

$codigo = trim($_POST["codigo"] ?? "");
$nombre = trim($_POST["nombre"] ?? "");
$tipo = $_POST["tipo"] ?? "";
$descripcion = trim($_POST["descripcion"] ?? "");
$ubicacion = trim($_POST["ubicacion"] ?? "");
$estado = $_POST["estado"] ?? "";

$tiposValidos = [
    "Laptop", "Proyector", "Tablet",
    "Camara", "Laboratorio"
];

$estadosValidos = [
    "Disponible", "Mantenimiento"
];

if (
    $codigo === "" ||
    $nombre === "" ||
    $ubicacion === "" ||
    mb_strlen($codigo) > 20 ||
    mb_strlen($nombre) > 100 ||
    mb_strlen($descripcion) > 255 ||
    mb_strlen($ubicacion) > 100 ||
    !in_array($tipo, $tiposValidos, true) ||
    !in_array($estado, $estadosValidos, true)
) {
    exit("Error: datos del equipo invalidos.");
}

try {
    $sql = "INSERT INTO equipos
            (codigo, nombre, tipo, descripcion,
             ubicacion, estado)
            VALUES
            (:codigo, :nombre, :tipo, :descripcion,
             :ubicacion, :estado)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":codigo" => $codigo,
        ":nombre" => $nombre,
        ":tipo" => $tipo,
        ":descripcion" => $descripcion ?: null,
        ":ubicacion" => $ubicacion,
        ":estado" => $estado
    ]);

    header("Location: index.php?guardado=1");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() === "23000") {
        exit("Error: el codigo del equipo ya existe.");
    }

    error_log($e->getMessage());
    exit("Error al guardar el equipo.");
}
?>
