<?php
session_start();
require_once 'Empresa.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_empresa'])) {
    $usuario = htmlspecialchars($_POST['usuario']);
    $contraseña = $_POST['contraseña'];

    $empresaModel = new Empresa();
    $empresa = $empresaModel->validarLogin($usuario, $contraseña);

    if ($empresa) {
        $_SESSION['usuario'] = [
            'id' => $empresa['id'],
            'nombre' => $empresa['nombre'],
            'rol' => 'empresa'
        ];
        session_regenerate_id(true); // Seguridad adicional
        header("Location: dashboard_empresa.php");
        exit();
    } else {
        $_SESSION['mensaje_error'] = "Credenciales incorrectas. Intenta nuevamente.";
        header("Location: login_empresa.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Empresa - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Iniciar Sesión como Empresa</h2>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <p class="mensaje-error"><?php echo htmlspecialchars($_SESSION['mensaje_error']); unset($_SESSION['mensaje_error']); ?></p>
    <?php endif; ?>

    <form action="login_empresa.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>

        <button type="submit" name="login_empresa">Ingresar</button>
    </form>

    <p><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p>
    <p><a href="index.php" class="btn">⬅ Regresar al inicio</a></p>
</body>
</html>