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

    // Devuelves la nueva fila de la tabla como respuesta
    echo "<tr id='row_{$nuevaAsignatura->getId()}'>
            <td>{$nuevaAsignatura->getId()}</td>
            <td>{$nuevaAsignatura->getNombre()}</td>
            <td>
                <button class='btn btn-danger eliminar' data-id='{$nuevaAsignatura->getId()}'>Eliminar</button>
            </td>
          </tr>";
    exit();
}

if ($action === 'eliminar' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $asignaturaManager->delete($id);
    
    // No es necesario devolver nada, ya que el AJAX eliminará la fila.
    exit();
}
?>
