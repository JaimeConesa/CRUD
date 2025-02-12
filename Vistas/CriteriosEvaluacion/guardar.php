<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $resultados_aprendizaje_id = $_POST['resultados_aprendizaje_id']; 

    // Validación
    if (empty($nombre) || empty($resultados_aprendizaje_id)) {
        die('El nombre y el resultado de aprendizaje son obligatorios.');
    }

    $conexion = ConexionDB::getInstancia()->getConexion();
    $criterioManager = new CriterioEvaluacionManager($conexion);

    // Crear nuevo criterio de evaluación
    $nuevoCriterio = new CriterioEvaluacion(null, $nombre, $resultados_aprendizaje_id); 
    
    if ($criterioManager->save($nuevoCriterio)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al guardar el criterio de evaluación.";
    }
}
?>
