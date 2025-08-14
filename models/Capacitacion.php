<?php
require_once __DIR__ . '/../core/Model.php';

class Capacitacion extends Model {

    public function obtenerTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM capacitaciones");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM capacitaciones WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->conn->prepare("INSERT INTO capacitaciones (nombre, descripcion, fecha, imagen_capacitacion) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha'],
            $data['imagen_capacitacion']
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = $this->conn->prepare("UPDATE capacitaciones SET nombre = ?, descripcion = ?, fecha = ?, imagen_capacitacion = ? WHERE id = ?");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha'],
            $data['imagen_capacitacion'],
            $id
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM capacitaciones WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
