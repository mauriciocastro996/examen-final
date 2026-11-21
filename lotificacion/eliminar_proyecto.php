
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: proyectos.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID del proyecto no valido.");
}

try {

    $sql = "DELETE FROM proyectos WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "id" => $id
    ]);

    header("Location: proyectos.php");
    exit;

} catch (PDOException $e) {

    if ($e->getCode() == "23000") {
        die("No se puede eliminar el proyecto porque tiene lotes relacionados.");
    }

    die("Error al eliminar el proyecto.");
}
?>
