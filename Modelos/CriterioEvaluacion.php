<?php

class CriterioEvaluacion {
    private ?int $id;
    private string $nombre;
    private int $ra_id;  

    public function __construct(?int $id, string $nombre, int $ra_id) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ra_id = $ra_id;  
    }

    public function getId():?int {
        return $this->id;
    }
    public function getNombre():?string {
        return $this->nombre;
    }
    public function getId_ra():int {
        return $this->ra_id;  
    }

    public function setNombre(string $nombre):void {
        $this->nombre = $nombre;
    }

    public function setId_ra(int $ra_id):void {
        $this->ra_id = $ra_id;  
    }
}


?>