<?php
require_once __DIR__ . '/../../config/conexion.php';
require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conexion = ConexionDB::getInstancia()->getConexion();
    $asignaturaManager = new AsignaturaManager($conexion);
    
    // Eliminar la asignatura
    $asignaturaManager->delete($id);

    // Redirigir de vuelta a la lista de asignaturas
    header('Location: index.php');
    exit();
} else {
    die('No se proporcionó un ID de asignatura válido.');
}
?>