<?php

class CriterioEvaluacion {
    private ?int $id;
    private string $nombre;
    private int $asignatura_id;  // Aquí usamos asignatura_id

    public function __construct(?int $id, string $nombre, int $asignatura_id) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->asignatura_id = $asignatura_id;  // Se pasa como parámetro a la clase
    }

    public function getId():?int {
        return $this->id;
    }
    public function getNombre():?string {
        return $this->nombre;
    }
    public function getId_asignatura():int {
        return $this->asignatura_id;  // Retornamos el id_asignatura
    }

    public function setNombre(string $nombre):void {
        $this->nombre = $nombre;
    }

    public function setId_asignatura(int $asignatura_id):void {
        $this->asignatura_id = $asignatura_id;  // Establecemos el id_asignatura
    }
}


?>