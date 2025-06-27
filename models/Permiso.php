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

    public function crear($tipo, $usuario_id) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (tipo, usuario_id) VALUES (:tipo, :usuario_id)");
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':usuario_id', $usuario_id);
        return $stmt->execute();
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $tipo, $usuario_id) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET tipo = :tipo, usuario_id = :usuario_id WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':usuario_id', $usuario_id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
