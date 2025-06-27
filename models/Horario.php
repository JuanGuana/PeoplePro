<?php
require_once __DIR__ . '/../core/Model.php';

class Horario extends Model {
    public function obtenerTodos() {
        $stmt = $this->conn->prepare("
            SELECT h.*, u.nombre AS usuario_nombre
            FROM horarios h
            JOIN users u ON h.usuario_id = u.id
            ORDER BY h.fecha DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM horarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO horarios (usuario_id, fecha, fecha_fin, hora_inicio, hora_fin, estado, observaciones)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['usuario_id'],
            $data['fecha'],
            $data['fecha_fin'],
            $data['hora_inicio'],
            $data['hora_fin'],
            $data['estado'],
            $data['observaciones']
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = $this->conn->prepare("
            UPDATE horarios
            SET usuario_id = ?, fecha = ?, fecha_fin = ?, hora_inicio = ?, hora_fin = ?, estado = ?, observaciones = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['usuario_id'],
            $data['fecha'],
            $data['fecha_fin'],
            $data['hora_inicio'],
            $data['hora_fin'],
            $data['estado'],
            $data['observaciones'],
            $id
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM horarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function obtenerUsuarios() {
    $stmt = $this->conn->prepare("SELECT id, nombre FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerPorUsuario($usuario_id) {
    $stmt = $this->conn->prepare("
        SELECT h.*, u.nombre AS usuario_nombre
        FROM horarios h
        JOIN users u ON h.usuario_id = u.id
        WHERE h.usuario_id = ?
        ORDER BY h.fecha DESC
    ");
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
