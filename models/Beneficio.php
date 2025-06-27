<?php
require_once __DIR__ . '/../core/Model.php';

class Beneficio extends Model {

    public function obtenerTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM beneficios ORDER BY fecha_inicio DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM beneficios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->conn->prepare("INSERT INTO beneficios (nombre, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = $this->conn->prepare("UPDATE beneficios SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ? WHERE id = ?");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $id
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM beneficios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
