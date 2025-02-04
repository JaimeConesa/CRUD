<?php

include 'conexion.php';
class AsignaturasDAO {
    private $id;
    private $nombre;

    public function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function CrearAsignatura($id, $nombre){
        try {
            $query = "INSERT INTO asignaturas (id, nombre) VALUES (?,?)";
            $stmt = $this->conexion->GetConexion()->prepare($query);
            $stmt->execute([$id, $nombre]);
        } catch (Exception $e) {
            die("Error al insertar asignatura: ") . $e->getMessage());
        }
    }
    public function MostrarAsignatura($id, $nombre){

    }
    public function ActualizarAsignatura($nombre){
        try {
            $query = "UPDATE asignaturas SET nombre = ?";
            $stmt = $this->conexion->getConexion()->prepare($query);
            $stmt->execute([$nombre]);
        } catch (Exception $e) {
            die("Error al actualizar asignatura: " . $e->getMessage());
        }
    }
    public function EliminarAsignatura($id, $nombre){

    }
}


?>