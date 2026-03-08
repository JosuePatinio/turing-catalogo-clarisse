<?php 
header("Access-Control-Allow-Origin: *");
header("Contetn-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/db.php';

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