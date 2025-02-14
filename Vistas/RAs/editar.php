<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/RAManager.php';
require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

$conexion = ConexionDB::getInstancia()->getConexion();
$rAManager = new RAManager($conexion);
$asignaturaManager = new AsignaturaManager($conexion);

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];
$resultados = $rAManager->findById($id);

if (!$resultados) {  // Aquí estaba el error
    die("Criterio de Evaluación no encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoNombre = $_POST["nombre"];
    $nuevaAsignaturaId = $_POST["asignatura_id"];

    $resultados->setNombre($nuevoNombre);
    $resultados->setId_asignatura($nuevaAsignaturaId);
    
    if ($rAManager->save($resultados)) {
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
<?php include __DIR__ . '/../encabezado.php'; ?>
<body>

<div class="container">
    <h2 class="mt-4">Editar Criterio de Evaluación</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del Criterio:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($resultados->getNombre()); ?>" required>
        </div>

        <div class="form-group">
            <label for="asignatura">Asignatura:</label>
            <select class="form-control" name="asignatura_id" required>
                <?php
                $asignaturas = $asignaturaManager->findAll();
                foreach ($asignaturas as $asignatura) {
                    $selected = ($resultados->getId_asignatura() == $asignatura->getId()) ? 'selected' : '';
                    echo "<option value='{$asignatura->getId()}' $selected>{$asignatura->getNombre()}</option>";
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
