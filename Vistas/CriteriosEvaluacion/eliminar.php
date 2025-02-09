<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conexion = ConexionDB::getInstancia()->getConexion();
    $criterioEvaluacionManager = new CriterioEvaluacionManager($conexion);

    // Eliminar el criterio de evaluación
    $criterioEvaluacionManager->delete($id);

    // Redirigir de vuelta a la lista de criterios de evaluación
    header('Location: index.php');
    exit();
} else {
    die('No se proporcionó un ID de criterio de evaluación válido.');
}
?>
