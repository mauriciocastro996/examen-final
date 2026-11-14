
<?php
require "conexion.php";

$stmt = $pdo->query(
    "SELECT * FROM equipos ORDER BY id DESC"
);

$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Registro de Equipos</title>

   

</head>

<body>

<header>
    <h1>Sistema de Registro de Equipos</h1>
</header>

<div class="contenedor">

    <h2>Listado de equipos</h2>

    
    <div class="acciones">

        <a href="agregar_equipo.php"
           class="btn-agregar">
         Agregar equipo
        </a>
        <br>

        <a href="reserva.php"
           class="btn-reserva">
            Registrar reserva
            <br>
        </a>
        <div class="acciones">
    <a href="agregar_equipo.php" class="btn-agregar">
        Agregar equipo
    
    </a>
    <br>

    <a href="reserva.php" class="btn-reserva">
        Registrar reserva
    </a>
</div>

    </div>

    <?php if (isset($_GET['guardado'])
              && $_GET['guardado'] === '1'): ?>

        <div class="mensaje">
            Equipo registrado correctamente.
        </div>

    <?php endif; ?>


    <div class="tabla">

        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ubicacion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($equipos) > 0): ?>

                    <?php foreach ($equipos as $equipo): ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars(
                                    $equipo['codigo']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $equipo['nombre']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $equipo['tipo']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $equipo['ubicacion']
                                ) ?>
                            </td>

                            <td>
                                <?php
                                $clase = $equipo['estado']
                                    === 'Disponible'
                                    ? 'disponible'
                                    : 'mantenimiento';
                                ?>

                                <span class="<?= $clase ?>">
                                    <?= htmlspecialchars(
                                        $equipo['estado']
                                    ) ?>
                                </span>
                            </td>

                            <td>
                                <?php if (
                                    $equipo['estado']
                                    === 'Disponible'
                                ): ?>

                                    <a class="btn-tabla"
                                       href="reserva.php?equipo_id=<?= (int)$equipo['id'] ?>">
                                        Reservar
                                    </a>

                                <?php else: ?>

                                    No disponible

                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="vacio">
                            No hay equipos registrados.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>

    </div>

</div>

</body>
</html>
