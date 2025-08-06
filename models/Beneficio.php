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
        $stmt = $this->conn->prepare("INSERT INTO beneficios (nombre, descripcion, fecha_inicio, fecha_fin, imagen) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $data['imagen']
        ]);
    }

    public function actualizar($id, $data) {
        // Construir la consulta dinámicamente (en caso de que no haya nueva imagen)
        $sql = "UPDATE beneficios SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ?";
        $params = [
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        ];

        if (!empty($data['imagen'])) {
            $sql .= ", imagen = ?";
            $params[] = $data['imagen'];
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function eliminar($id) {
        // Primero obtener la imagen
        $stmt = $this->conn->prepare("SELECT imagen FROM beneficios WHERE id = ?");
        $stmt->execute([$id]);
        $beneficio = $stmt->fetch(PDO::FETCH_ASSOC);

        // Eliminar imagen del servidor si existe
        if ($beneficio && $beneficio['imagen'] && file_exists(__DIR__ . '/../' . $beneficio['imagen'])) {
            unlink(__DIR__ . '/../' . $beneficio['imagen']);
        }

        // Eliminar el registro de la base de datos
        $stmt = $this->conn->prepare("DELETE FROM beneficios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

