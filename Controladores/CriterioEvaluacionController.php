<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../Modelos/CriteriosEvaluacionManager.php';
require_once __DIR__ . '/../Modelos/CriteriosEvaluacion.php';

$conexion = ConexionDB::getInstancia()->getConexion();
$criteriosEvaluacionManager = new CriteriosEvaluacionManager($conexion);

// Verifica la acción a realizar
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'guardar':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST['id'] ?? null;
            $nombre = $_POST['nombre'] ?? '';
            $resultado_aprendizaje_id = $_POST['resultado_aprendizaje_id'] ?? '';  // Cambiar aquí

            if (!empty($nombre) && !empty($resultado_aprendizaje_id)) {  // Cambiar aquí
                // Usar el nuevo campo 'resultado_aprendizaje_id' en lugar de 'id_asignatura'
                $criterio = new CriteriosEvaluacion($id ? (int) $id : null, $nombre, (int) $resultado_aprendizaje_id);  // Cambiar aquí
                $criteriosEvaluacionManager->save($criterio);
            }
        }
        header("Location: ../vistas/criteriosEvaluacion.php");
        exit;

    case 'eliminar':
        if (isset($_GET['id'])) {
            $criteriosEvaluacionManager->delete((int) $_GET['id']);
        }
        header("Location: ../vistas/criteriosEvaluacion.php");
        exit;

    default:
        header("Location: ../vistas/criteriosEvaluacion.php");
        exit;
}
?>
