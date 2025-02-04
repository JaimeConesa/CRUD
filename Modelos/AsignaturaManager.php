<?php
require_once 'Asignatura.php';

class AsignaturaManager {
    private PDO $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    // Buscar por ID
    public function findById(int $id): ?Asignatura {
        $query = "SELECT * FROM asignaturas WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        return new Asignatura($row['id'], $row['nombre']);
    }

    // Obtener todas las asignaturas
    public function findAll(): array {
        $query = "SELECT * FROM asignaturas";
        $stmt = $this->conexion->query($query);
        $asignaturas = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $asignaturas[] = new Asignatura($row['id'], $row['nombre']);
        }

        return $asignaturas;
    }

    // Guardar (Insertar o actualizar)
    public function save(Asignatura $asignatura): bool {
        if ($asignatura->getId()) {
            // Actualizar
            $query = "UPDATE asignaturas SET nombre = :nombre WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $asignatura->getId(), PDO::PARAM_INT);
        } else {
            // Insertar
            $query = "INSERT INTO asignaturas (nombre) VALUES (:nombre)";
            $stmt = $this->conexion->prepare($query);
        }

        $stmt->bindParam(":nombre", $asignatura->getNombre(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Eliminar
    public function delete(int $id): bool {
        $query = "DELETE FROM asignaturas WHERE id = :id";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
