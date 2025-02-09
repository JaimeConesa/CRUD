<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Criterio de Evaluación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2>Agregar Nuevo Criterio de Evaluación</h2>
    <form action="guardar.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Criterio:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="asignatura_id">Asignatura:</label>
            <select class="form-control" id="asignatura_id" name="asignatura_id" required>
                <?php
                require_once __DIR__ . '/../../config/conexion.php';
                require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

                $conexion = ConexionDB::getInstancia()->getConexion();
                $asignaturaManager = new AsignaturaManager($conexion);
                $asignaturas = $asignaturaManager->findAll();

                foreach ($asignaturas as $asignatura) {
                    echo "<option value='{$asignatura->getId()}'>{$asignatura->getNombre()}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>      

</body>
</html>
