<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($password, $usuario['password'])) {
            return ['usuario' => $usuario];
        } else {
            return ['error' => 'Credenciales incorrectas'];
        }
    }

    public function crear($nombre, $email, $password, $rol, $area_id) {
        try {
            $stmt = $this->conn->prepare("
                INSERT INTO users (nombre, email, password, rol, area_id) 
                VALUES (?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$nombre, $email, $password, $rol, $area_id]);
        } catch (PDOException $e) {
            error_log('Error en crear usuario: ' . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodosConArea() {
        $stmt = $this->conn->prepare("
            SELECT u.*, a.nombre AS nombre_area 
            FROM users u 
            LEFT JOIN areas a ON u.area_id = a.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $email, $rol, $area_id) {
        $stmt = $this->conn->prepare("
            UPDATE users SET nombre = ?, email = ?, rol = ?, area_id = ? WHERE id = ?
        ");
        return $stmt->execute([$nombre, $email, $rol, $area_id, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function obtenerAreas() {
        $stmt = $this->conn->query("SELECT * FROM areas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método necesario para módulo de permisos (usuarios básicos)
    public function obtenerTodos() {
        $stmt = $this->conn->prepare("SELECT id, nombre FROM users WHERE rol = 'usuario'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
