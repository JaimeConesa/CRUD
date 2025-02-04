<?php

$server = "localhost";
$host = "root";
$pass = "";
$db = "crud";

$conexion = new mysqli ($server, $host , $pass, $db);


if ($conexion ->connect_errno) {
    die("Conexión fallida" . $conexion->connect_errno);
} else {
    echo "Conexión establecida";
}


?>

