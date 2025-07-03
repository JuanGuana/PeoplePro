<?php
require_once __DIR__ . '/../core/Model.php';

class Visitante extends Model
{
    public function obtenerTodos()
    {
        $sql = "SELECT * FROM visitantes ORDER BY fecha_ingreso DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($nombre, $documento, $empresa, $fecha_ingreso, $motivo)
    {
        $sql = "INSERT INTO visitantes (nombre, documento, empresa, fecha_ingreso, motivo) 
                VALUES (:nombre, :documento, :empresa, :fecha_ingreso, :motivo)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre'        => $nombre,
            'documento'     => $documento,
            'empresa'       => $empresa,
            'fecha_ingreso' => $fecha_ingreso,
            'motivo'        => $motivo
        ]);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM visitantes WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $documento, $empresa, $fecha_ingreso, $motivo)
    {
        $sql = "UPDATE visitantes 
                SET nombre = :nombre, documento = :documento, empresa = :empresa, 
                    fecha_ingreso = :fecha_ingreso, motivo = :motivo 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre'        => $nombre,
            'documento'     => $documento,
            'empresa'       => $empresa,
            'fecha_ingreso' => $fecha_ingreso,
            'motivo'        => $motivo,
            'id'            => $id
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM visitantes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    public function contarVisitantesHoy()
    {
        $hoy = date('Y-m-d');
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM visitantes WHERE DATE(fecha_visita) = ?");
        $stmt->execute([$hoy]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
