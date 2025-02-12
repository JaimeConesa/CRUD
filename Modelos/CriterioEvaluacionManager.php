<?php
require_once 'CriterioEvaluacion.php';

class CriterioEvaluacionManager {
    private PDO $conexion;

    public function __construct(PDO $conexion) {
        $this->conexion = $conexion;
    }

    // Buscar por ID
    public function findById(int $id): ?CriterioEvaluacion {
        try {
            $query = "SELECT * FROM criterios_evaluacion WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_OBJ);
            if (!$row) {
                return null;
            }

            return new CriterioEvaluacion($row->id, $row->nombre, $row->resultados_aprendizaje_id );
        } catch (PDOException $e) {
            die("Error al buscar el criterio de evaluación: " . $e->getMessage());
        }
    }

    // Obtener todos los criterios
    public function findAll(): array {
        try {
            $query = "SELECT * FROM criterios_evaluacion";
            $stmt = $this->conexion->query($query);
            $criterios = [];

            while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                $criterios[] = new CriterioEvaluacion($row->id, $row->nombre, $row->resultados_aprendizaje_id );
            }

            return $criterios;
        } catch (PDOException $e) {
            die("Error al obtener los criterios de evaluación: " . $e->getMessage());
        }
    }

    // Guardar (Insertar o actualizar)
    public function save(CriterioEvaluacion $criterio): bool {
        try {
            if ($criterio->getId()) {
                // Actualizar
                $query = "UPDATE criterios_evaluacion SET nombre = :nombre, resultados_aprendizaje_id  = :resultados_aprendizaje_id  WHERE id = :id";
                $stmt = $this->conexion->prepare($query);
                $id = $criterio->getId();
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            } else {
                // Insertar
                $query = "INSERT INTO criterios_evaluacion (nombre, resultados_aprendizaje_id ) VALUES (:nombre, :resultados_aprendizaje_id )";
                $stmt = $this->conexion->prepare($query);
            }

            $nombre = $criterio->getNombre();
            $resultados_aprendizaje_id  = $criterio->getIdRA();
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":resultados_aprendizaje_id ", $resultados_aprendizaje_id , PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al guardar el criterio de evaluación: " . $e->getMessage());
        }
    }

    // Eliminar
    public function delete(int $id): bool {
        try {
            $query = "DELETE FROM criterios_evaluacion WHERE id = :id";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error al eliminar el criterio de evaluación: " . $e->getMessage());
        }
    }
}
?>
