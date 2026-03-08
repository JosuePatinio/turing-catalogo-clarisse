<?php 
//Permitir  que cualquier origen acceda a la API, habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Conexion a la base de datos
require_once '../config/db.php';
$id_categoria = isset($_GET['id_categoria']) ? (int)$_GET['id_categoria'] : null;

$sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.stock, p.imagen_url, p.id_categoria, c.rango_edad
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id";

if ($id_categoria) {
    $sql .= " WHERE p.id_categoria = $id_categoria";
}
$resultado = $conexion->query($sql);
$productos = [];


while($fila = $resultado->fetch_assoc()){
    $productos[]=$fila;
}
//Convertir arreglo a JSON
echo json_encode($productos);
$conexion->close();
?>