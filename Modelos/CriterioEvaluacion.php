<?php

class CriterioEvaluacion {
    private ?int $id;
    private string $nombre;

    public function __construct(?int $id, string $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function getId():?int {
        return $this->id;
    }

    }
    public function MostrarCriterioEvaluacion($id, $nombre){

    }
    public function ActualizarCriterioEvaluacion($id, $nombre){

    }
    public function EliminarCriterioEvaluacion($id, $nombre){

    }
}


?>