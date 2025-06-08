<?php
require_once 'database.php';

class Usuario {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function registrarUsuario($usuario, $correo, $contraseña, $nombre, $apellidos, $dui, $fecha_nacimiento, $rol) {
        // Validar que el usuario tenga más de 18 años
        $edad = date_diff(date_create($fecha_nacimiento), date_create('today'))->y;
        if ($edad < 18) {
            return false; // Restricción de edad
        }

        // Validar que el correo no esté repetido
        $stmt = $this->pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $stmt->execute([$correo]);
        if ($stmt->rowCount() > 0) {
            return false; // Correo ya existe
        }

        // Hash de la contraseña para seguridad
        $hash_password = password_hash($contraseña, PASSWORD_BCRYPT);

        // Insertar usuario en la base de datos
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (usuario, correo, contraseña, nombre, apellidos, dui, fecha_nacimiento, rol) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$usuario, $correo, $hash_password, $nombre, $apellidos, $dui, $fecha_nacimiento, $rol]);
    }

    // Método para validar el login de usuarios
    public function validarLogin($usuario, $contraseña) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validar la contraseña
        if ($user && password_verify($contraseña, $user['contraseña'])) {
            return $user;
        }
        return false;
    }
}
?>