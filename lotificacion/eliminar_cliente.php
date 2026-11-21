
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: clientes.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID no valido.");
}

try {

    $sql = "DELETE FROM clientes WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "id" => $id
    ]);

    header("Location: clientes.php");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() == "23000") {
        die("No se puede eliminar el cliente porque tiene registros relacionados.");
    }

    die("Error al eliminar el cliente.");
}
?>
