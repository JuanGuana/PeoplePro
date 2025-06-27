<?php
require_once __DIR__ . '/../core/Model.php';

class Documento extends Model {
    public function obtenerTodosConUsuario() {
        $stmt = $this->conn->prepare("
            SELECT d.*, u.nombre AS usuario
            FROM documentos d
            LEFT JOIN users u ON d.usuario_id = u.id
            ORDER BY d.fecha_subida DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorUsuario($usuario_id) {
        $stmt = $this->conn->prepare("SELECT * FROM documentos WHERE usuario_id = ? ORDER BY fecha_subida DESC");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $archivo, $usuario_id) {
        $stmt = $this->conn->prepare("INSERT INTO documentos (nombre, archivo, usuario_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $archivo, $usuario_id]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM documentos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
