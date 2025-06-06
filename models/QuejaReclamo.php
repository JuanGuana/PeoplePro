<?php
class QuejaReclamo {
    private $conn;
    private $table = "quejas_reclamos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodos() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table ORDER BY fecha DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $correo, $mensaje) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nombre, correo, mensaje) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $correo, $mensaje]);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $correo, $mensaje) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET nombre = ?, correo = ?, mensaje = ? WHERE id = ?");
        return $stmt->execute([$nombre, $correo, $mensaje, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
