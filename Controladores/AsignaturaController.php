<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../Modelos/Asignatura.php';
require_once __DIR__ . '/../Modelos/AsignaturaManager.php';

$conexion = ConexionDB::getInstancia()->getConexion();
$asignaturaManager = new AsignaturaManager($conexion);
$action = $_GET['action'] ?? '';

if ($action === 'guardar' && $_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';

    if (empty($nombre)) {
        die("El nombre es obligatorio.");
    }

    $nuevaAsignatura = new Asignatura(null, $nombre);
    $asignaturaManager->save($nuevaAsignatura);

    header("Location: ../Vista/Asignaturas/index.php");
    exit();
}

if ($action === 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $asignaturaManager->delete($id);

    header("Location: ../Vista/Asignaturas/index.php");
    exit();
}
?>
