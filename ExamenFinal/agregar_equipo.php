
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Agregar Equipo Nuevos </title>

</head>
<body>

<div class="contenedor">

    <h2>Registrar nuevo equipo</h2>
    <p>Complete los datos del equipo.</p>

    <form action="guardar_equipo.php" method="POST">

        <label>Codigo del equipo</label>
        <input type="text" name="codigo"
               maxlength="20" required>
    <br>

        <label>Nombre del equipo</label>
        <input type="text" name="nombre"
               maxlength="100" required>
<br>
        <label>Tipo de equipo</label>
        <select name="tipo" required>
            <option value="">Seleccione</option>
            <option value="Laptop">Laptop</option>
            <option value="Proyector">Proyector</option>
            <option value="Tablet">Tablet</option>
            <option value="Camara">Camara</option>
            <option value="Laboratorio">Laboratorio</option>
        </select>
<br>
        <label>Descripcion</label>
        <textarea name="descripcion"
                  maxlength="255" rows="3"></textarea>
<br>
        <label>Ubicacion</label>
        <input type="text" name="ubicacion"
               maxlength="100" required>
<br>
        <label>Estado</label>
        <select name="estado" required>
            <option value="Disponible">Disponible</option>
            <option value="Mantenimiento">Mantenimiento</option>
        </select>

        <div class="botones">
            <button type="submit">Guardar equipo</button>
            <a href="index.php" class="cancelar">
                Cancelar
            </a>
        </div>

    </form>

</div>

</body>
</html>
