<?php
session_start();
require_once 'database.php';

try {
    $stmt = $pdo->query("SELECT * FROM ofertas WHERE estado = 'disponible'");
    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error al cargar ofertas: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Cupones - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Compra de Cupones</h1>
        <nav>
            <a href="index.php" class="btn">⬅ Regresar al inicio</a>
            <?php if (isset($_SESSION['usuario'])): ?>
                <a href="logout.php" class="btn">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php" class="btn">Iniciar sesión</a>
                <a href="registro.php" class="btn">Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <section>
            <h2>Ofertas disponibles</h2>
            <div class="ofertas-container">
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php else: ?>
                    <?php foreach ($ofertas as $oferta): ?>
                        <article class="oferta">
                            <h3><?php echo htmlspecialchars($oferta['titulo']); ?></h3>
                            <p>Precio Regular: <s>$<?php echo number_format($oferta['precio_regular'], 2); ?></s></p>
                            <p><strong>Precio Oferta: $<?php echo number_format($oferta['precio_oferta'], 2); ?></strong></p>
                            <p>Fecha límite de canje: <?php echo htmlspecialchars($oferta['fecha_limite_canje']); ?></p>
                            <p><?php echo htmlspecialchars($oferta['descripcion']); ?></p>

                            <form action="comprar.php" method="POST">
                                <input type="hidden" name="oferta_id" value="<?php echo $oferta['id']; ?>">
                                <button type="submit" class="btn">Comprar</button>
                            </form>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>La Cuponera SV © 2025 - Todos los derechos reservados.</p>
    </footer>
</body>
</html>