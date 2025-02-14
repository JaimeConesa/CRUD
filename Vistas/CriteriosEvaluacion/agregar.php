<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Resultado de aprendizaje de Evaluación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<?php include __DIR__ . '/../encabezado.php'; ?>
<body>
<div class="container">
    <h2>Agregar Nuevo criterio de evaluación</h2>
    <form action="guardar.php" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del criterio de evaluación:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
    <label for="ra_id">Resultado de Aprendizaje:</label>
    <select class="form-control" id="ra_id" name="ra_id" required>
        <?php
        require_once __DIR__ . '/../../config/conexion.php';
        require_once __DIR__ . '/../../Modelos/RAManager.php';

        $conexion = ConexionDB::getInstancia()->getConexion();
        $rAManager = new RAManager($conexion);
        $ras = $rAManager->findAll();

        foreach ($ras as $ra) {
            echo "<option value='{$ra->getId()}'>{$ra->getNombre()}</option>";
        }
        ?>
    </select>
</div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>      

</body>
<?php include __DIR__ . '/../pie.php'; ?>
</html>
