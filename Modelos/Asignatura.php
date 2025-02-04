<?php

class Asignatura {
    private ?int $id;
    private string $nombre;


    public function __construct(?int $id, string $nombre,) {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }


    // Setters
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

}

?>
