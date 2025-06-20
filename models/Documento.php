<?php
require_once __DIR__ . '/../config/database.php';

class Documento
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function guardar($nombre, $archivo)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO documentos (nombre, archivo) VALUES (?, ?)");
            $stmt->execute([$nombre, $archivo]);
            return true;
        } catch (PDOException $e) {
            error_log("Error al guardar documento: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodos()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM documentos ORDER BY id DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener documentos: " . $e->getMessage());
            return [];
        }
    }

    public function eliminar($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM documentos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            error_log("Error al eliminar documento: " . $e->getMessage());
            return false;
        }
    }

    public function buscarPorId($id)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM documentos WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al buscar documento: " . $e->getMessage());
            return null;
        }
    }

    public function actualizar($id, $nombre, $archivo = null)
    {
        try {
            if ($archivo) {
                $stmt = $this->db->prepare("UPDATE documentos SET nombre = ?, archivo = ? WHERE id = ?");
                $stmt->execute([$nombre, $archivo, $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE documentos SET nombre = ? WHERE id = ?");
                $stmt->execute([$nombre, $id]);
            }
            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar documento: " . $e->getMessage());
            return false;
        }
    }
}
