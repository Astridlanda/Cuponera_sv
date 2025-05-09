<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registro de Usuario</h2>

    <?php
    if (isset($_SESSION['mensaje_exito'])) {
        echo "<p class='mensaje-exito'>{$_SESSION['mensaje_exito']}</p>";
        unset($_SESSION['mensaje_exito']); // Limpiar el mensaje después de mostrarlo
    }
    ?>

    <form action="AuthController.php" method="POST">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>

        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>

        <label for="dui">DUI:</label>
        <input type="text" name="dui" required>

        <label for="fecha_nacimiento">Fecha de nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required>

        <label for="rol">Rol:</label>
        <select name="rol">
            <option value="cliente">Cliente</option>
            <option value="empresa">Empresa</option>
        </select>

        <button type="submit" name="registro">Registrarse</button>
    </form>
</body>
</html>
