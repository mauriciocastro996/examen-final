
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dpi = trim($_POST["dpi"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $direccion = trim($_POST["direccion"] ?? "");

    if (
        $nombre == "" ||
        $apellido == "" ||
        !preg_match('/^[0-9]{13}$/', $dpi)
    ) {
        exit("Datos del cliente no validos.");
    }

    try {

        $sql = "INSERT INTO clientes
                (nombre, apellido, dpi, telefono, direccion)
                VALUES
                (:nombre, :apellido, :dpi, :telefono, :direccion)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":dpi" => $dpi,
            ":telefono" => $telefono,
            ":direccion" => $direccion
        ]);

        header("Location: clientes.php");
        exit;

    } catch (PDOException $e) {

        if ($e->getCode() == "23000") {
            exit("El DPI ya se encuentra registrado.");
        }

        exit("Error al guardar el cliente.");
    }
}

header("Location: clientes.php");
exit;
?>
