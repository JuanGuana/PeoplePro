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
        if (!$usuario_id) return [];
        $stmt = $this->conn->prepare("SELECT * FROM documentos WHERE usuario_id = ? ORDER BY fecha_subida DESC");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ...existing code...
    public function obtenerNombreUsuario($usuario_id) {
        $stmt = $this->conn->prepare("SELECT nombre FROM users WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['nombre'] : '';
}
// ...existing code...

    public function crear($nombre, $archivo, $usuario_id) {
        if (empty($nombre) || empty($archivo) || !$usuario_id) return false;
        $stmt = $this->conn->prepare("INSERT INTO documentos (nombre, archivo, usuario_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $archivo, $usuario_id]);
    }

    public function eliminar($id) {
        // Obtener ruta del archivo antes de eliminar
        $stmt = $this->conn->prepare("SELECT archivo FROM documentos WHERE id = ?");
        $stmt->execute([$id]);
        $doc = $stmt->fetch(PDO::FETCH_ASSOC);

        // Eliminar registro
        $stmt = $this->conn->prepare("DELETE FROM documentos WHERE id = ?");
        $result = $stmt->execute([$id]);

        // Eliminar archivo físico si existe
        if ($result && $doc && !empty($doc['archivo'])) {
            $ruta = __DIR__ . '/../' . $doc['archivo'];
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }
        return $result;
    }
    
public function obtenerUsuariosConDocumentos() {
    $stmt = $this->conn->prepare("
        SELECT u.id, u.nombre
        FROM users u
        INNER JOIN documentos d ON d.usuario_id = u.id
        GROUP BY u.id, u.nombre
        ORDER BY u.nombre ASC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}