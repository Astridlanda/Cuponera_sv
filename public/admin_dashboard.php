<?php
session_start();
require_once 'Admin.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['es_admin'] !== TRUE) {
    header("Location: index.php");
    exit();
}

$adminModel = new Admin();
$reportes = $adminModel->obtenerReportes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Administración del Sistema</h2>

    <section>
        <h3>Registrar Nuevo Administrador</h3>
        <form action="AdminController.php" method="POST">
            <label>Usuario:</label>
            <input type="text" name="usuario" required>

            <label>Correo:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contraseña" required>

            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" required>

            <button type="submit" name="registro_admin">Registrar Administrador</button>
        </form>
    </section>

    <section>
        <h3>Reportes de Ventas</h3>
        <table>
            <tr>
                <th>Empresa</th>
                <th>Total Cupones Vendidos</th>
                <th>Total Ganancias</th>
                <th>Total Ventas</th>
            </tr>
            <?php foreach ($reportes as $reporte): ?>
                <tr>
                    <td><?= $reporte['nombre'] ?></td>
                    <td><?= $reporte['total_cupones_vendidos'] ?></td>
                    <td>$<?= $reporte['total_ganancias'] ?></td>
                    <td>$<?= $reporte['total_ventas'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</body>
</html>
