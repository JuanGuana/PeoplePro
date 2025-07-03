<?php
require_once __DIR__ . '/../core/Model.php';
class Beneficio extends Model
{
    private $table = 'beneficios';

    public function obtenerTodos()
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function guardar($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (nombre, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin']
        ]);
    }

    public function actualizar($data)
    {
        $stmt = $this->conn->prepare("UPDATE $this->table SET nombre = ?, descripcion = ?, fecha_inicio = ?, fecha_fin = ? WHERE id = ?");
        return $stmt->execute([
            $data['nombre'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $data['id']
        ]);
    }

    public function eliminar($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function contarBeneficios()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM beneficios");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
