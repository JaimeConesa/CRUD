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
                <th>Resultado de Aprendizaje</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../../config/conexion.php';
            require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';
            require_once __DIR__ . '/../../Modelos/RAManager.php';

            $conexion = ConexionDB::getInstancia()->getConexion();
            $criterioManager = new CriterioEvaluacionManager($conexion);
            $rAManager = new RAManager($conexion);
            $criterios = $criterioManager->findAll();

            foreach ($criterios as $criterio) {
                // Obtener el nombre del Resultado de Aprendizaje al que pertenece
                $raId = $criterio->getRAId();
                $ra = $rAManager->findById($raId);
                $raNombre = $ra ? $ra->getNombre() : "Desconocido";

                // Mostrar los datos en la tabla
                echo "<tr>
                        <td>{$criterio->getId()}</td>
                        <td>{$criterio->getNombre()}</td>
                        <td>{$raNombre}</td> <!-- Mostrar el nombre del RA -->
                        <td>
                            <a href='editar.php?id={$criterio->getId()}' class='btn btn-warning'>Editar</a>
                            <a href='eliminar.php?id={$criterio->getId()}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que deseas eliminar este criterio?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
