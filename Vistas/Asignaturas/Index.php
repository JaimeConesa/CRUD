<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Lista de Asignaturas</h2>

    <a href="agregar.php" class="btn btn-primary mb-3">Agregar Nueva Asignatura</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
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
                            <a href='editar.php?id={$asignatura->getId()}' class='btn btn-warning'>Editar</a>
                            <a href='eliminar.php?id={$asignatura->getId()}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que deseas eliminar esta asignatura?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
