<?php
require_once 'Asignatura.php';

class AsignaturaManager {
    private PDO $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    // Buscar por ID
    public function findById(int $id): ?Asignatura {
        try {
            $query = "SELECT * FROM asignaturas WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return null;
            }

            return new Asignatura($row['id'], $row['nombre']); // Asegúrate de que tu clase Asignatura tiene estos atributos.
        } catch (PDOException $e) {
            die("Error al buscar la asignatura: " . $e->getMessage());
        }
    }

    // Obtener todas las asignaturas
    public function findAll(): array {
        try {
            $query = "SELECT * FROM asignaturas";
            $stmt = $this->conexion->query($query);
            $asignaturas = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $asignaturas[] = new Asignatura($row['id'], $row['nombre']);
            }

            return $asignaturas;
        } catch (PDOException $e) {
            die("Error al obtener las asignaturas: " . $e->getMessage());
        }
    }

    // Guardar (Insertar o actualizar)
    public function save(Asignatura $asignatura): bool {
        try {
            if ($asignatura->getId()) {
                // Actualizar
                $query = "UPDATE asignaturas SET nombre = :nombre WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $id = $asignatura->getId(); // Asignar el ID a una variable
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            } else {
                // Insertar
                $query = "INSERT INTO asignaturas (nombre) VALUES (:nombre,)";
                $stmt = $this->conexion->prepare($query);
            }
    
            // Guardamos valores en variables antes de pasarlos a bindParam
            $nombre = $asignatura->getNombre();    
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);    
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al guardar la asignatura: " . $e->getMessage());
        }
    }
    

    // Eliminar
    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM asignaturas WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al eliminar la asignatura: " . $e->getMessage());
        }
    }
}
?>
