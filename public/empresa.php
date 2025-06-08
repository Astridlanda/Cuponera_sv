<?php
    require_once 'database.php';

    class Empresa {
        private $pdo;

        public function __construct() {
            global $pdo;
            $this->pdo = $pdo;
        }

        // Verificar si el NIT ya existe antes de registrar
        public function nitExiste($nit) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM empresas WHERE nit = ?");
            $stmt->execute([$nit]);
            return $stmt->fetchColumn() > 0;
        }

        // Registro de una nueva empresa con validación de NIT
        public function registrarEmpresa($nombre, $nit, $direccion, $telefono, $correo, $usuario, $contraseña) {
            if ($this->nitExiste($nit)) {
                return false; // Evitar registro si el NIT ya existe
            }

            $hash_password = password_hash($contraseña, PASSWORD_BCRYPT);
            $stmt = $this->pdo->prepare(
                "INSERT INTO empresas (nombre, nit, direccion, telefono, correo, usuario, contraseña, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')"
            );
            return $stmt->execute([$nombre, $nit, $direccion, $telefono, $correo, $usuario, $hash_password]);
        }

        // Método corregido para obtener el ID de la empresa por usuario
        public function obtenerIdPorUsuario($usuario) {
            $stmt = $this->pdo->prepare("SELECT id FROM empresas WHERE usuario = ?");
            $stmt->execute([$usuario]);
            $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
            return $empresa ? $empresa['id'] : null;
        }
        public function validarLogin($usuario, $contraseña) {
        $stmt = $this->pdo->prepare("SELECT id, nombre, contraseña FROM empresas WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $empresa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($empresa && password_verify($contraseña, $empresa['contraseña'])) {
            return [
                'id' => $empresa['id'],
                'nombre' => $empresa['nombre']
            ];
        }

        return false; // Credenciales incorrectas
    }

    }
    ?>