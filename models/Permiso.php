<?php
require_once __DIR__ . '/../core/Model.php';

class Permiso extends Model
{
    private $table = "permisos";

    public function obtenerTodos()
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($tipo)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (tipo) VALUES (:tipo)");
        $stmt->bindParam(':tipo', $tipo);
        return $stmt->execute();
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $tipo)
    {
        $stmt = $this->conn->prepare("UPDATE $this->table SET tipo = :tipo WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $tipo);
        return $stmt->execute();
    }

    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    public function contarPermisos()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) AS total FROM $this->table");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
