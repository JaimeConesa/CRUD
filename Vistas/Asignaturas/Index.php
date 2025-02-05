<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>

    <!-- Incluir el CDN de Bootstrap -->
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-pzjw8f+ua7Kw1TIq0cPzP9eOatgX2WxZxI60HpWz63FL6gr/sCZSmQY34wp6U5kB" crossorigin="anonymous">

    <!-- Bootstrap JS (opcional, si necesitas interactividad como modales o dropdowns) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zyi1coR3RrD9Yds7JpW6pa5p9VEXgA4JCa+JLMc9" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0cPzP9eOatgX2WxZxI60HpWz63FL6gr/sCZSmQY34wp6U5kB" crossorigin="anonymous"></script>
</head>
<body>

<h2>Agregar Nueva Asignatura</h2>
<form id="formAsignatura" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<h2>Lista de Asignaturas</h2>
<table class="table table-bordered" id="tablaAsignaturas">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../config/conexion.php';
        require_once __DIR__ . '/../../Modelos/AsignaturaManager.php';

        $conexion = ConexionDB::getInstancia()->getConexion();
        $asignaturaManager = new AsignaturaManager($conexion);
        $asignaturas = $asignaturaManager->findAll();

        foreach ($asignaturas as $asignatura) {
            echo "<tr id='row_{$asignatura->getId()}'>
                    <td>{$asignatura->getId()}</td>
                    <td>{$asignatura->getNombre()}</td>
                    <td>
                        <button class='btn btn-danger eliminar' data-id='{$asignatura->getId()}'>Eliminar</button>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

<script>
    // Agregar asignatura con AJAX
    $('#formAsignatura').submit(function(e) {
        e.preventDefault(); // Evitar recarga de la página

        var nombre = $('#nombre').val();

        $.ajax({
            url: '../../Controladores/AsignaturaController.php?action=guardar',
            type: 'POST',
            data: {nombre: nombre},
            success: function(response) {
                // Actualizar la lista de asignaturas sin recargar la página
                $('#tablaAsignaturas tbody').append(response);
                $('#nombre').val(''); // Limpiar el campo de texto
            },
            error: function() {
                alert('Error al agregar la asignatura.');
            }
        });
    });

    // Eliminar asignatura con AJAX
    $(document).on('click', '.eliminar', function() {
        var id = $(this).data('id');
        
        $.ajax({
            url: '../../Controladores/AsignaturaController.php?action=eliminar&id=' + id,
            type: 'GET',
            success: function() {
                // Eliminar la fila de la tabla sin recargar la página
                $('#row_' + id).remove();
            },
            error: function() {
                alert('Error al eliminar la asignatura.');
            }
        });
    });
</script>

</body>
</html>
