<?php
require_once 'database.php';

class Admin {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Registrar un nuevo administrador
    public function registrarAdministrador($usuario, $correo, $contraseña, $nombre, $apellidos) {
        $hash_password = password_hash($contraseña, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (usuario, correo, contraseña, nombre, apellidos, rol, es_admin) VALUES (?, ?, ?, ?, ?, 'administrador', TRUE)");
        return $stmt->execute([$usuario, $correo, $hash_password, $nombre, $apellidos]);
    }

    // Obtener reportes de empresas
    public function obtenerReportes() {
        $stmt = $this->pdo->query(
            "SELECT e.nombre, r.total_cupones_vendidos, r.total_ganancias, r.total_ventas
            FROM reportes r
            INNER JOIN empresas e ON r.empresa_id = e.id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
