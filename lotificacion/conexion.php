
<?php

$servidor = "localhost";
$base_datos = "lotificacion_las_marias";
$usuario = "root";
$contrasena = "";

try {

    $pdo = new PDO(
        "mysql:host=$servidor;dbname=$base_datos;charset=utf8mb4",
        $usuario,
        $contrasena
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die("Error de conexion: " . $e->getMessage());

}
?>
