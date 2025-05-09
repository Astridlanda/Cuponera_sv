<?php
session_start();
require_once 'Usuario.php';

$usuarioModel = new Usuario();

// Inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $user = $usuarioModel->validarLogin($usuario, $contraseña);

    if ($user) {
        $_SESSION['usuario'] = $user['usuario']; // Guardamos el usuario en sesión
        $_SESSION['rol'] = $user['rol']; // Guardamos el rol
        header("Location: bienvenida.php"); // Redirigir a bienvenida
        exit();
    } else {
        echo "Credenciales incorrectas. <a href='login.php'>Volver</a>";
    }
}
?>
