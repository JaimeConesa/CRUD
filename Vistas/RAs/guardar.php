<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/RAManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $asignatura_id = $_POST['asignatura_id']; 

    // Validación
    if (empty($nombre) || empty($asignatura_id)) {
        die('El nombre y la asignatura son obligatorios.');
    }

    $conexion = ConexionDB::getInstancia()->getConexion();
    $rAManager = new RAManager($conexion);
    

    $nuevoRA = new RA (null, $nombre, $asignatura_id); 
    
    if ($rAManager->save($nuevoRA)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al guardar el criterio de evaluación.";
    }
}
?>
