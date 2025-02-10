<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criterios de Evaluación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Lista de Criterios de Evaluación</h2>

    <a href="agregar.php" class="btn btn-primary mb-3">Agregar Nuevo Criterio</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Asignatura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../../config/conexion.php';
            require_once __DIR__ . '/../../Modelos/RAManager.php';
            require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

            $conexion = ConexionDB::getInstancia()->getConexion();
            $rAManager = new RAManager($conexion);
            $resultado = $rAManager->findAll();

            foreach ($resultado as $resultados) {
                // Obtener el nombre de la asignatura
                $asignaturaId = $resultados->getId_asignatura();
                $asignaturaManager = new AsignaturaManager($conexion);
                $asignatura = $asignaturaManager->findById($asignaturaId);

                // Mostrar los datos en la tabla
                echo "<tr>
                        <td>{$resultados->getId()}</td>
                        <td>{$resultados->getNombre()}</td>
                        <td>{$asignatura->getNombre()}</td> <!-- Mostrar el nombre de la asignatura -->
                        <td>
                            <a href='editar.php?id={$resultados->getId()}' class='btn btn-warning'>Editar</a>
                            <a href='eliminar.php?id={$resultados->getId()}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que deseas eliminar este criterio?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
