<?php
$host = "localhost";
$db = "registro_equipos";
$usuario = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $usuario,
        $password,
        [
            PDO::ATTR_ERRMODE =>
                PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("Error de conexión.");
}
?>