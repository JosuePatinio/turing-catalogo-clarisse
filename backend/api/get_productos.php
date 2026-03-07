<?php 
//Permitir  que cualquier origen acceda a la API, habilitar CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Conexion a la base de datos
require_once '../config/db.php';

$sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.imagen_url, c.rango_edad
        FROM productos p
        LEFT JOIN categorias c ON p.id_categoria = c.id";

$resultado = $conexion->query($sql);

$productos = array();

if ($resultado->num_rows>0){
    while($fila = $resultado->fetch_assoc()){
        array_push($productos, $fila);
    }
    //Convertir arreglo a JSON
    echo json_encode($productos);
}else{
    echo json_encode([]);
}

$conexion->close();
?>