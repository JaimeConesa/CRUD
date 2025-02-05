<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
</head>
<body>

<h2>Agregar Nueva Asignatura</h2>
<form action="AsignaturaController.php?action=guardar" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <br>
    <button type="submit">Guardar</button>
</form>

<h2>Lista de Asignaturas</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>

    <?php
    require_once __DIR__ . '/../../config/conexion.php';
    require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

    $conexion = ConexionDB::getInstancia()->getConexion();
    $asignaturaManager = new AsignaturaManager($conexion);
    $asignaturas = $asignaturaManager->findAll();

    foreach ($asignaturas as $asignatura) {
        echo "<tr>
                <td>{$asignatura->getId()}</td>
                <td>{$asignatura->getNombre()}</td>
                <td>
                    <a href='AsignaturaController.php?action=eliminar&id={$asignatura->getId()}'>Eliminar</a>
                </td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
