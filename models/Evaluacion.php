<?php
require_once '../config/Database.php'; // Asegúrate que tienes una clase para la conexión PDO

class Evaluacion {
    private $conn;

   public function __construct() {
    $this->conn = Database::connect();
}




    public function obtenerTodos() {
        $query = $this->conn->prepare("SELECT * FROM evaluaciones ORDER BY fecha DESC");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = $this->conn->prepare("SELECT * FROM evaluaciones WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $query = $this->conn->prepare("INSERT INTO evaluaciones (nombre, descripcion, fecha) VALUES (:nombre, :descripcion, :fecha)");
        $query->bindParam(':nombre', $data['nombre']);
        $query->bindParam(':descripcion', $data['descripcion']);
        $query->bindParam(':fecha', $data['fecha']);
        return $query->execute();
    }

    public function actualizar($id, $data) {
        $query = $this->conn->prepare("UPDATE evaluaciones SET nombre = :nombre, descripcion = :descripcion, fecha = :fecha WHERE id = :id");
        $query->bindParam(':nombre', $data['nombre']);
        $query->bindParam(':descripcion', $data['descripcion']);
        $query->bindParam(':fecha', $data['fecha']);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function eliminar($id) {
        $query = $this->conn->prepare("DELETE FROM evaluaciones WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}
