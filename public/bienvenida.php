
<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .bienvenida-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 25px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #007bff;
            font-size: 24px;
        }

        h3 {
            font-size: 20px;
            color: #444;
        }

        .mensaje-bienvenida {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
            text-align: left;
        }

        ul li {
            background-color: #f1f1f1;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 10px 5px 0;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="bienvenida-container">
        <h2>¡Bienvenido, <?= htmlspecialchars($usuario) ?>!</h2>
        <p class="mensaje-bienvenida">
             <strong>La Cuponera SV</strong>.
        </p>

        <h3>¿Qué puedes hacer en nuestra plataforma?</h3>
        <ul>
            <li>Explorar ofertas exclusivas con grandes descuentos.</li>
            <li>Comprar cupones y recibir tu factura digital.</li>
            <li>Canjear cupones en establecimientos afiliados.</li>
            <li>Si eres empresa, puedes publicar ofertas para atraer clientes.</li>
        </ul>

        <?php if ($rol === 'administrador'): ?>
            <a href="admin_dashboard.php" class="btn">Ir al Panel de Administración</a>
        <?php elseif ($rol === 'empresa'): ?>
            <a href="empresa_dashboard.php" class="btn">Ir a tu Panel de Empresa</a>
        <?php else: ?>
            <a href="dashboard.php" class="btn">Ir a tu Cuenta</a>
        <?php endif; ?>

        <a href="index.php" class="btn">Ir a la Página Principal</a>
    </div>
</body>
</html>
