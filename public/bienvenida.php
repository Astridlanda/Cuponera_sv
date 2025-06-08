<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php
    session_start();
    if (isset($_SESSION['mensaje_exito'])) {
        echo "<p class='mensaje-exito'>" . htmlspecialchars($_SESSION['mensaje_exito']) . "</p>";
        unset($_SESSION['mensaje_exito']); // Limpiar mensaje después de mostrarlo
    }
    ?>

    <form action="AuthController.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>

        <button type="submit" name="login">Ingresar</button>
    </form>

    <p><a href="recuperar.php">¿Olvidaste tu contraseña?</a></p>
    <p><a href="index.php" class="btn">⬅ Regresar al inicio</a></p>
</body>
</html>