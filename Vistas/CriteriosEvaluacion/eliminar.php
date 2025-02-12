<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conexion = ConexionDB::getInstancia()->getConexion();
    $criterioManager = new CriterioEvaluacionManager($conexion);

    // Intentar eliminar el criterio de evaluación
    if ($criterioManager->delete($id)) {
        header('Location: index.php');
        exit();
    } else {
        die('Error al eliminar el criterio de evaluación.');
    }
} else {
    die('No se proporcionó un ID de criterio de evaluación válido.');
}
?>
