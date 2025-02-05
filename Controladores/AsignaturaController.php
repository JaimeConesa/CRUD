<?php
require_once __DIR__ . '/../config/conexion.php'; // Subir un nivel
require_once 'AsignaturaManager.php';

// Obtener la conexión
$conexion = ConexionDB::getInstancia()->getConexion();  
$asignaturaManager = new AsignaturaManager($conexion);

// Buscar todas las asignaturas
$asignaturas = $asignaturaManager->findAll();
foreach ($asignaturas as $asignatura) {
    echo $asignatura->getNombre() . "<br>";
}

// Insertar una nueva asignatura
// Verificar qué acción realizar
$action = $_GET['action'] ?? '';

if ($action === 'guardar' && $_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $codigo = $_POST['codigo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($codigo) || empty($descripcion)) {
        die("Todos los campos son obligatorios.");
    }

    // Crear una nueva asignatura y guardarla
    $nuevaAsignatura = new Asignatura(null, $nombre);
    $asignaturaManager->save($nuevaAsignatura);

    // Redirigir a index.php para ver la lista actualizada
    header("Location: index.php");
    exit();
}

// Buscar por ID
$asignatura = $asignaturaManager->findById(1);
if ($asignatura) {
    echo "Asignatura encontrada: " . $asignatura->getNombre();
}

// Eliminar una asignatura
$asignaturaManager->delete(2);

?>
