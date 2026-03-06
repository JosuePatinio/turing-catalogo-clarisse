<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

include_once '../config/db.php';

$datos = json_decode(file_get_contents("php://input"));

if(!empty($datos->username) && !empty($datos->password)){
    $user = $conexion ->real_escape_string($datos->username);
    $pass = $datos->password;

    $sql= "SELECT id, nombre_usuario, password, rol FROM usuarios WHERE nombre_usuario ='$user'";
    $resultado = $conexion->query($sql);

    if($resultado->num_rows>0){
        $fila = $resultado->fetch_assoc();

        if(password_verify($pass, $fila['password'])){
            echo json_encode([
                "status" => "success",
                "message" => "Acceso concedido",
                "user" => [
                    "id" => $fila['id'],
                    "username" =>$fila['nombre_usuario'],
                    "rol" =>$fila['rol']
                ]
            ]);
        }else{
        echo json_encode(["status" => "error", "message" => "Contraseña Incorrecta"]);
    }
    } else{
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
    }
} else{
        echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}

$conexion->close();

?>