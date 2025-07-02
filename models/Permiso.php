<?php
require_once __DIR__ . '/../core/Model.php';

class Permiso extends Model {
    private $table = "permisos";

    public function obtenerTodos() {
        $stmt = $this->conn->prepare("
            SELECT p.*, u.nombre AS usuario 
            FROM $this->table p 
            LEFT JOIN users u ON p.usuario_id = u.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->conn->prepare("
            SELECT p.*, u.nombre AS usuario 
            FROM $this->table p 
            LEFT JOIN users u ON p.usuario_id = u.id
            WHERE p.usuario_id = :usuario_id
        ");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($tipo, $usuario_id, $estado = 'pendiente', $fecha_inicio = null, $fecha_fin = null) {
        $stmt = $this->conn->prepare("
            INSERT INTO $this->table (tipo, usuario_id, estado, fecha_inicio, fecha_fin)
            VALUES (:tipo, :usuario_id, :estado, :fecha_inicio, :fecha_fin)
        ");
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':fecha_inicio', $fecha_inicio);
        $stmt->bindParam(':fecha_fin', $fecha_fin);
        return $stmt->execute();
    }

    public function actualizarEstado($id, $estado) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET estado = :estado WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':estado', $estado);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
