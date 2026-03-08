<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método no permitido. Se esperaba DELETE."]);
    exit();
}

$datos = json_decode(file_get_contents("php://input"));

if(!empty($datos->id)){
    $id = (int)$datos->id;
    $sql = "DELETE FROM productos WHERE id = $id";

    if($conexion->query($sql)){
        echo json_encode(["status" => "success", "message" => "Producto eliminado con éxito"]);
    }else{
        echo json_encode(["status" => "error", "message" => "Error al eliminar"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID no proporcionado"]);
}

$conexion->close();
?>