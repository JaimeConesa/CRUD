<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/CriterioEvaluacionManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $asignatura_id = $_POST['asignatura_id']; // Usamos asignatura_id, que es el nombre del campo en el formulario

    // Validación
    if (empty($nombre) || empty($asignatura_id)) {
        die('El nombre y la asignatura son obligatorios.');
    }

    $conexion = ConexionDB::getInstancia()->getConexion();
    $criterioEvaluacionManager = new CriterioEvaluacionManager($conexion);
    
    // Asegúrate de pasar el nombre y el id_asignatura correctos
    $nuevoCriterio = new CriterioEvaluacion(null, $nombre, $asignatura_id); 
    
    // Guardar el criterio de evaluación
    if ($criterioEvaluacionManager->save($nuevoCriterio)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al guardar el criterio de evaluación.";
    }
}
?>
