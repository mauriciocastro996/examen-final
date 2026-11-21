
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: clientes.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$dpi = trim($_POST["dpi"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$direccion = trim($_POST["direccion"] ?? "");

if (
    !$id ||
    $nombre === "" ||
    $apellido === "" ||
    !preg_match('/^[0-9]{13}$/', $dpi)
) {
    die("Datos no validos.");
}

try {
    $sql = "UPDATE clientes SET
            nombre = :nombre,
            apellido = :apellido,
            dpi = :dpi,
            telefono = :telefono,
            direccion = :direccion
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "nombre" => $nombre,
        "apellido" => $apellido,
        "dpi" => $dpi,
        "telefono" => $telefono,
        "direccion" => $direccion,
        "id" => $id
    ]);

    header("Location: clientes.php");
    exit;

} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        die("El DPI ya pertenece a otro cliente.");
    }

    die("Error al actualizar el cliente.");
}
?>
