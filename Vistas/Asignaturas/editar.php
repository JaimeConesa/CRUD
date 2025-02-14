<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

$conexion = ConexionDB::getInstancia()->getConexion();
$asignaturaManager = new AsignaturaManager($conexion);

if (!isset($_GET['id'])) {
    die("ID no especificado.");
}

$id = $_GET['id'];
$asignatura = $asignaturaManager->findById($id);

if (!$asignatura) {
    die("Asignatura no encontrada.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoNombre = $_POST["nombre"];
    $asignatura->setNombre($nuevoNombre);
    
    if ($asignaturaManager->save($asignatura)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar la asignatura.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asignatura</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<?php include __DIR__ . '/../encabezado.php'; ?>
<body>


<div class="container">
    <h2 class="mt-4">Editar Asignatura</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($asignatura->getNombre()); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
<?php include __DIR__ . '/../pie.php'; ?>
</html>
