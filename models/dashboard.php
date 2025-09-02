<?php
require_once __DIR__ . '/../config/database.php';

class Dashboard {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Visitantes hoy, semana, mes
    public function visitantesHoy() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM visitantes WHERE DATE(fecha_ingreso) = CURDATE()");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function visitantesSemana() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM visitantes WHERE YEARWEEK(fecha_ingreso, 1) = YEARWEEK(CURDATE(), 1)");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function visitantesMes() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM visitantes WHERE YEAR(fecha_ingreso) = YEAR(CURDATE()) AND MONTH(fecha_ingreso) = MONTH(CURDATE())");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Usuarios activos
    public function usuariosActivos() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM users");
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
