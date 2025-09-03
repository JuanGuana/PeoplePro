<?php
require_once __DIR__ . '/../config/database.php';

class Dashboard {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Visitantes hoy
    public function visitantesHoy() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM visitantes WHERE DATE(fecha_ingreso) = CURDATE()");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Visitantes sin salida registrada
    public function visitantesDentro() {
        $stmt = $this->conn->query("
            SELECT id, nombre, documento, empresa, fecha_ingreso
            FROM visitantes
            WHERE fecha_salida IS NULL OR fecha_salida = '0000-00-00 00:00:00'
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Usuarios activos
    public function usuariosActivos() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM users WHERE estado = 'activo'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Usuarios inactivos (vacaciones, incapacitado, suspendido)
    public function usuariosInactivos() {
        $stmt = $this->conn->query("
            SELECT COUNT(*) AS total 
            FROM users 
            WHERE estado <> 'activo'
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }


    // Empleados por área
    public function empleadosPorArea() {
        $stmt = $this->conn->query("
            SELECT a.nombre AS area, COUNT(u.id) AS total_empleados
            FROM areas a
            LEFT JOIN users u ON u.area_id = a.id
            GROUP BY a.id, a.nombre
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Permisos pendientes
    public function permisosPendientes() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM permisos WHERE estado = 'pendiente'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
