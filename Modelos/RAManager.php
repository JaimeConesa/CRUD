<?php
require_once 'RA.php';

class RAManager {
    private PDO $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    // Buscar por ID
    public function findById(int $id): ?RA {  // Cambié RAs a RA
        try {
            $query = "SELECT * FROM resultados_aprendizaje WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_OBJ);
            if (!$row) {
                return null;
            }

            return new RA($row->id, $row->nombre, $row->asignatura_id);  // Cambié RAs a RA
        } catch (PDOException $e) {
            die("Error al buscar el criterio de evaluación: " . $e->getMessage());
        }
    }

    // Obtener todos los criterios
    public function findAll(): array {
        try {
            $query = "SELECT * FROM resultados_aprendizaje";
            $stmt = $this->conexion->query($query);
            $resultados = [];

            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $resultados[] = new RA($row->id, $row->nombre, $row->asignatura_id);
            }

            return $resultados;
        } catch (PDOException $e) {
            die("Error al obtener los criterios de evaluación: " . $e->getMessage());
        }
    }

    // Guardar (Insertar o actualizar)
    public function save(RA $resultados): bool {  // Cambié RAs a RA
        try {
            if ($resultados->getId()) {
                // Actualizar
                $query = "UPDATE resultados_aprendizaje SET nombre = :nombre, asignatura_id = :asignatura_id WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $id = $resultados->getId();
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            } else {
                // Insertar
                $query = "INSERT INTO resultados_aprendizaje (nombre, asignatura_id) VALUES (:nombre, :asignatura_id)";
                $stmt = $this->conexion->prepare($query);
            }

            $nombre = $resultados->getNombre();
            $asignatura_id = $resultados->getId_asignatura();
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":asignatura_id", $asignatura_id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al guardar el criterio de evaluación: " . $e->getMessage());
        }
    }

    // Eliminar
    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM resultados_aprendizaje WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al eliminar el criterio de evaluación: " . $e->getMessage());
        }
    }
}
?>
