<?php
session_start();
require_once 'Empresa.php';

$empresaModel = new Empresa();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro_empresa'])) {
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Intentar registrar la empresa
    if ($empresaModel->registrarEmpresa($nombre, $nit, $direccion, $telefono, $correo, $usuario, $contraseña)) {
        $_SESSION['usuario'] = [
            'nombre' => $usuario,
            'rol' => 'empresa',
            'id' => $empresaModel->obtenerIdPorUsuario($usuario)
        ];
        $_SESSION['mensaje_exito'] = "Registro exitoso. ¡Ahora puedes agregar tus ofertas!";
        header("Location: dashboard_empresa.php");
        exit();
    } else {
        $_SESSION['mensaje_error'] = "El NIT ya está registrado. Intenta con otro.";
        header("Location: registro_empresa.php");
        exit();
    }
}
?>