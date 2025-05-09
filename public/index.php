<?php
session_start();
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenido a La Cuponera SV</h1>
        <nav>
            <?php if (isset($_SESSION['usuario'])): ?>
                <?php if ($_SESSION['usuario']['rol'] === 'administrador'): ?>
                    <a href="admin_dashboard.php">Panel de Administración</a>
                <?php elseif ($_SESSION['usuario']['rol'] === 'empresa'): ?>
                    <a href="empresa_dashboard.php">Panel de Empresa</a>
                <?php else: ?>
                    <a href="dashboard.php">Mi Cuenta</a>
                <?php endif; ?>
                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn">Iniciar sesión</a>
                <a href="registro.php" class="btn">Registrarse</a>
                <a href="registro_empresa.php" class="btn">Registrar Empresa</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section>
            <h2>Ofertas disponibles</h2>
            <div class="ofertas-container">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM ofertas WHERE estado = 'disponible'");
                    while ($oferta = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<article class='oferta'>";
                        echo "<h3>{$oferta['titulo']}</h3>";
                        echo "<p>Precio Regular: <s>\${$oferta['precio_regular']}</s></p>";
                        echo "<p><strong>Precio Oferta: \${$oferta['precio_oferta']}</strong></p>";
                        echo "<p>Fecha límite de canje: {$oferta['fecha_limite_canje']}</p>";
                        echo "<p>{$oferta['descripcion']}</p>";
                        echo "<a href='registro.php' class='btn'>Registrarse para comprar</a>";
                        echo "</article>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error'>Error al cargar ofertas: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>La Cuponera SV © 2025 - Todos los derechos reservados.</p>
    </footer>
</body>
</html>
