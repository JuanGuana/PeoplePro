<?php

class Capacitacion {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'peoplepro');
        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM capacitaciones";
        $result = $this->db->query($sql);

        $capacitaciones = [];
        while ($row = $result->fetch_assoc()) {
            $capacitaciones[] = $row;
        }

        return $capacitaciones;
    }
}
