<?php
class Horario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT h.*, u.nombre FROM horarios h JOIN users u ON h.user_id = u.id ORDER BY h.fecha DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM horarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->pdo->prepare("INSERT INTO horarios (user_id, fecha, hora_entrada, hora_salida, estado, observaciones) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['fecha'],
            $data['hora_entrada'],
            $data['hora_salida'],
            $data['estado'],
            $data['observaciones']
        ]);
    }

    public function actualizar($id, $data) {
        $stmt = $this->pdo->prepare("UPDATE horarios SET user_id = ?, fecha = ?, hora_entrada = ?, hora_salida = ?, estado = ?, observaciones = ? WHERE id = ?");
        return $stmt->execute([
            $data['user_id'],
            $data['fecha'],
            $data['hora_entrada'],
            $data['hora_salida'],
            $data['estado'],
            $data['observaciones'],
            $id
        ]);
    }

    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM horarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function obtenerUsuarios() {
        $stmt = $this->pdo->query("SELECT id, nombre FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
