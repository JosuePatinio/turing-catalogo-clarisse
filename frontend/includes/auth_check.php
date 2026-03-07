<?php
session_start();

function requerir_login(){
    if(!isset($_SESSION['id_usuario'])){
        header("Location: login.php?error=auth_required");
        exit();
    }
}

function admin_only() {
    requerir_login();
    if ($_SESSION['rol'] !== 'admin') {
        // Si no es admin, lo mandamos al login de inmediato
        header("Location: index.php?error=admin_only");
        exit();
    }
}


// Funcion para saber si alguien esta logueado
function esta_logeado() {
    return isset($_SESSION['id_usuario']);
}
?>