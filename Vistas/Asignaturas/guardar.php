<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];

    // Validación
    if (empty($nombre)) {
        die('El nombre es obligatorio.');
    }

    $conexion = ConexionDB::getInstancia()->getConexion();
    $asignaturaManager = new AsignaturaManager($conexion);
    $nuevaAsignatura = new Asignatura(null, $nombre);
    
    // Guardar la asignatura
    $asignaturaManager->save($nuevaAsignatura);

    // Redirigir de vuelta a la lista de asignaturas
    header('Location: index.php');
    exit();
}
?>