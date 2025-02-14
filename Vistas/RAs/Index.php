<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criterios de Evaluación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
        .btn i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<?php include __DIR__ . '/../encabezado.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary"><i class="fa-solid fa-list-check"></i> Criterios de Evaluación</h2>
        <a href="agregar.php" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Agregar Nuevo Criterio
        </a>
    </div>

    <div class="table-responsive shadow-lg p-3 bg-white rounded">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Asignatura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once __DIR__ . '/../../config/conexion.php';
                require_once __DIR__ . '/../../Modelos/RAManager.php';
                require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

                $conexion = ConexionDB::getInstancia()->getConexion();
                $rAManager = new RAManager($conexion);
                $resultado = $rAManager->findAll();

                foreach ($resultado as $resultados) {
                    // Obtener el nombre de la asignatura
                    $asignaturaId = $resultados->getId_asignatura();
                    $asignaturaManager = new AsignaturaManager($conexion);
                    $asignatura = $asignaturaManager->findById($asignaturaId);

                    // Mostrar los datos en la tabla
                    echo "<tr>
                            <td>{$resultados->getId()}</td>
                            <td>{$resultados->getNombre()}</td>
                            <td>{$asignatura->getNombre()}</td>
                            <td>
                                <a href='editar.php?id={$resultados->getId()}' class='btn btn-warning btn-sm'>
                                    <i class='fa-solid fa-pen'></i> Editar
                                </a>
                                <a href='eliminar.php?id={$resultados->getId()}' class='btn btn-danger btn-sm' 
                                   onclick='return confirm(\"¿Seguro que deseas eliminar este criterio?\")'>
                                    <i class='fa-solid fa-trash'></i> Eliminar
                                </a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../pie.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
