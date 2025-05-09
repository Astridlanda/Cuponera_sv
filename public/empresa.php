<?php
require_once 'database.php';

class Empresa {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Registro de una nueva empresa
    public function registrarEmpresa($nombre, $nit, $direccion, $telefono, $correo, $usuario, $contraseña) {
        $hash_password = password_hash($contraseña, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO empresas (nombre, nit, direccion, telefono, correo, usuario, contraseña, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')"
        );
        return $stmt->execute([$nombre, $nit, $direccion, $telefono, $correo, $usuario, $hash_password]);
    }

    // Obtener empresas pendientes de aprobación
    public function obtenerEmpresasPendientes() {
        $stmt = $this->pdo->query("SELECT * FROM empresas WHERE estado = 'pendiente'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Aprobar empresa y asignar comisión
    public function aprobarEmpresa($id_empresa, $porcentaje_comision) {
        $stmt = $this->pdo->prepare("UPDATE empresas SET estado = 'aprobado', porcentaje_comision = ? WHERE id = ?");
        return $stmt->execute([$porcentaje_comision, $id_empresa]);
    }

    // Rechazar empresa
    public function rechazarEmpresa($id_empresa) {
        $stmt = $this->pdo->prepare("UPDATE empresas SET estado = 'rechazado' WHERE id = ?");
        return $stmt->execute([$id_empresa]);
    }
}
?>
