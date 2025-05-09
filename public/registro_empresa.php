<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empresa - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registro de Empresa</h2>
    <form action="EmpresaController.php" method="POST">
        <label for="nombre">Nombre de empresa:</label>
        <input type="text" name="nombre" required>

        <label for="nit">NIT:</label>
        <input type="text" name="nit" required>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" name="correo" required>

        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" required>

        <button type="submit" name="registro_empresa">Registrar Empresa</button>
    </form>
</body>
</html>
