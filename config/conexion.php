<?php
class ConexionDB {
    private static $instancia = null;
    private $conexion;

    private function __construct() {
        $server = "localhost";
        $dbname = "crud";
        $usuario = "root";
        $password = "";

        try {
            $this->conexion = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $usuario, $password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
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
?>
