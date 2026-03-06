<?php
session_start();

// Función para proteger páginas de administración
function admin_only() {
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
        // Si no es admin, lo mandamos al login de inmediato
        header("Location: login.php");
        exit();
    }
}

// Función para saber si alguien está logueado (para no imprimir header)
function is_logged_in() {
    return isset($_SESSION['id_usuario']);
}
?>