<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';
require_once __DIR__ . '/../../Modelos/RAManager.php';

$conexion = ConexionDB::getInstancia()->getConexion();
$criterioManager = new CriterioEvaluacionManager($conexion);
$raManager = new RAManager($conexion);

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];
$criterio = $criterioManager->findById($id);

if (!$criterio) {
    die("Criterio de Evaluación no encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoNombre = $_POST["nombre"];
    $nuevoRaId = $_POST["ra_id"]; // Cambiado a `ra_id`

    $criterio->setNombre($nuevoNombre);
    $criterio->setRaId($nuevoRaId); // Cambiado a `setRaId()`
    
    if ($criterioManager->save($criterio)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el criterio de evaluación.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Criterio de Evaluación</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Editar Criterio de Evaluación</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Criterio:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($criterio->getNombre()); ?>" required>
        </div>

        <div class="form-group">
            <label for="ra_id">Resultado de Aprendizaje:</label>
            <select class="form-control" name="ra_id" required> <!-- Cambiado a `ra_id` -->
                <?php
                $ras = $raManager->findAll();
                foreach ($ras as $ra) {
                    $selected = ($criterio->getRaId() == $ra->getId()) ? 'selected' : ''; // Cambiado a `getRaId()`
                    echo "<option value='{$ra->getId()}' $selected>{$ra->getNombre()}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>
