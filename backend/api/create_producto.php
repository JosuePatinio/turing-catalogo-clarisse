<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../config/db.php';


$datos = json_decode(file_get_contents("php://input"));

if(!empty($datos->nombre) && !empty($datos->precio) && !empty($datos->id_categoria)){
    
    // Limpiar datos para evitar inyecciones
    $nombre = $conexion->real_escape_string($datos->nombre);
    $descripcion = $conexion->real_escape_string($datos->descripcion);
    $precio = (float)$datos->precio;
    $stock = (int)$datos->stock;
    $id_categoria = (int)$datos->id_categoria;
    $imagen_url = $conexion->real_escape_string($datos->imagen_url);

    $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, imagen_url, id_categoria) 
            VALUES ('$nombre', '$descripcion', $precio, $stock, '$imagen_url', $id_categoria)";

    if($conexion->query($sql)){
        echo json_encode(["status" => "success", "message" => "Producto creado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al guardar: " . $conexion->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}

$conexion->close();
?>