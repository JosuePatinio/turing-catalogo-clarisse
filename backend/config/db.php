<?php 

$host = "localhost";
$db_name = "catalogo_clarisse";
$username = "root";
$password = "";

$conexion = new mysqli($host, $username, $password, $db_name);

if($conexion->connect_error){
    die("Error de conexion " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
//echo "Conexión exitosa con MySQLi";
?>