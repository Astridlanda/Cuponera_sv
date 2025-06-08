<?php
session_start();
require_once 'Usuario.php';

$usuarioModel = new Usuario();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $user = $usuarioModel->validarLogin($usuario, $contraseña);

    if ($user) {
        $_SESSION['usuario'] = [
            'nombre' => $user['usuario'],
            'rol' => $user['rol']
        ];
        header("Location: bienvenida.php"); // Redirigir a bienvenida
        exit();
    } else {
        $_SESSION['mensaje_exito'] = "Credenciales incorrectas. Intenta nuevamente.";
        header("Location: login.php"); // Regresar al login con mensaje
        exit();
    }
}
?>