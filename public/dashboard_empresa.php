<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empresa - La Cuponera SV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Panel de Gestión de Cupones</h1>
        <nav>
            <a href="index.php" class="btn">⬅ Regresar al inicio</a>
            <a href="logout.php" class="btn">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Mis Cupones</h2>

            <?php if (isset($_SESSION['mensaje_exito'])): ?>
                <p class="mensaje-exito"><?php echo htmlspecialchars($_SESSION['mensaje_exito']); unset($_SESSION['mensaje_exito']); ?></p>
            <?php endif; ?>

            <?php if (isset($_SESSION['mensaje_error'])): ?>
                <p class="mensaje-error"><?php echo htmlspecialchars($_SESSION['mensaje_error']); unset($_SESSION['mensaje_error']); ?></p>
            <?php endif; ?>

            <h3>Agregar nueva oferta</h3>
            <form action="dashboard_empresa.php" method="POST">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" required>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" required></textarea>

                <label for="precio_regular">Precio Regular:</label>
                <input type="number" name="precio_regular" required>

                <label for="precio_oferta">Precio Oferta:</label>
                <input type="number" name="precio_oferta" required>

                <label for="fecha_limite_canje">Fecha límite de canje:</label>
                <input type="date" name="fecha_limite_canje" required>

                <button type="submit" name="nueva_oferta">Agregar Oferta</button>
            </form>

            <h3>Ofertas activas</h3>
            <div class="ofertas-container">
                <?php if (empty($ofertas)): ?>
                    <p>No tienes ofertas activas.</p>
                <?php else: ?>
                    <?php foreach ($ofertas as $oferta): ?>
                        <article class="oferta">
                            <h3><?php echo htmlspecialchars($oferta['titulo']); ?></h3>
                            <p>Precio Regular: <s>$<?php echo number_format($oferta['precio_regular'], 2); ?></s></p>
                            <p><strong>Precio Oferta: $<?php echo number_format($oferta['precio_oferta'], 2); ?></strong></p>
                            <p>Fecha límite de canje: <?php echo htmlspecialchars($oferta['fecha_limite_canje']); ?></p>
                            <p><?php echo htmlspecialchars($oferta['descripcion']); ?></p>
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