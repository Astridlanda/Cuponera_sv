<?php
require_once 'Empresa.php';

$empresaModel = new Empresa();

// Registro de empresas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registro_empresa'])) {
    $nombre = $_POST['nombre'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    if ($empresaModel->registrarEmpresa($nombre, $nit, $direccion, $telefono, $correo, $usuario, $contraseña)) {
        header("Location: login.php");
    } else {
        echo "Error al registrar la empresa.";
    }
}

// Aprobación de empresas (por parte del administrador)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aprobar_empresa'])) {
    $id_empresa = $_POST['id_empresa'];
    $porcentaje_comision = $_POST['porcentaje_comision'];

    if ($empresaModel->aprobarEmpresa($id_empresa, $porcentaje_comision)) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error al aprobar la empresa.";
    }
}

// Rechazo de empresas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rechazar_empresa'])) {
    $id_empresa = $_POST['id_empresa'];

    if ($empresaModel->rechazarEmpresa($id_empresa)) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error al rechazar la empresa.";
    }
}
?>
