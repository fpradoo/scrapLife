<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Nuestra manera personalizada segura de iniciar sesi�n PHP.
 
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // La contrase�a con hash
 
    if (login($email, $password, $mysqli) == true) {
        // Inicio de sesi�n exitosa
        header('Location:/admin/index.php');
    } else {		
        // Inicio de sesi�n no exitosa
        header("Location:/admin/login.php?error=1");
    }
} else {
    // Las variables POST correctas no se enviaron a esta p�gina.
    echo 'Solicitud no v�lida';
}