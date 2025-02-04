<?php

class ConexionDB {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        $server = "localhost";
        $host = "root";
        $pass = "";
        $db = "crud";

        $this->conexion = new mysqli($server, $host, $pass, $db);

        if ($this->conexion->connect_errno) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public static function getInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function getConexion() {
        return $this->conexion;
    }
}

// Uso del Singleton
$conexion = ConexionDB::getInstancia()->getConexion();
echo "Conexión establecida";

?>

