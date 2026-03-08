<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    http_response_code(405); //ERror por si el metodo no es el correcto
    echo json_encode(["status" => "error", "message" => "Método no permitido. Se esperaba PUT."]);
    exit();
}

$datos = json_decode(file_get_contents("php://input"));

if(!empty($datos->id) && !empty($datos->nombre)){
    $id = (int)$datos->id;
    $nombre = $conexion->real_escape_string($datos->nombre);
    $precio = (float)$datos->precio;
    $id_categoria = (int)$datos->id_categoria;

    $sql = "UPDATE productos SET nombre='$nombre', precio=$precio, id_categoria=$id_categoria WHERE id=$id";

    if($conexion->query($sql)){
        echo json_encode(["status" => "success", "message" => "Producto actualizado"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar"]);
    }
}
$conexion->close();
?>