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

// Verificar si el criterio existe
if (!$criterio) {
    die("Criterio de Evaluación no encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger los datos enviados en el formulario
    $nuevoNombre = $_POST["nombre"];
    $nuevoRaId = isset($_POST["ra_id"]) && is_numeric($_POST["ra_id"]) ? (int)$_POST["ra_id"] : null;

    // Verificar que el ra_id no esté vacío y es válido
    if ($nuevoRaId !== null) {
        $criterio->setNombre($nuevoNombre);  // Actualizar el nombre
        $criterio->setId_ra($nuevoRaId);      // Actualizar el ra_id

        // Intentar guardar los cambios
        if ($criterioManager->save($criterio)) {
            header("Location: index.php");  // Redirigir al listado después de guardar
            exit();
        } else {
            echo "Error al actualizar el criterio de evaluación.";
        }
    } else {
        echo "El Resultado de Aprendizaje es obligatorio.";
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
<?php include __DIR__ . '/../encabezado.php'; ?>
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
            <select class="form-control" name="ra_id" required>
                <?php
                    // Obtener todos los resultados de aprendizaje
                    $ras = $raManager->findAll();
                    foreach ($ras as $ra) {
                        // Verificar si el resultado de aprendizaje está seleccionado
                        $selected = ($criterio->getId_ra() == $ra->getId()) ? 'selected' : '';
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
<?php include __DIR__ . '/../pie.php'; ?>
</html>
