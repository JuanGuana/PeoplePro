<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 🔐 Autenticación
    public function autenticar($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($password, $usuario['password'])) {
            return ['usuario' => $usuario];
        } else {
            return ['error' => '❌ Credenciales incorrectas'];
        }
    }

    // ➕ Crear usuario
        public function crear($nombre, $email, $password, $rol, $area_id, $foto_perfil = null, $direccion = '', $telefono = '') {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Si no hay imagen subida, usamos default
            $ruta_foto = 'public/img/foto_perfil/default.png';

            if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . "_" . basename($foto_perfil['name']);
                $ruta_foto = 'uploads/' . $nombreArchivo;
                move_uploaded_file($foto_perfil['tmp_name'], __DIR__ . '/../public/' . $ruta_foto);
            }

            $stmt = $this->conn->prepare("
                INSERT INTO users (nombre, email, password, rol, area_id, foto_perfil, direccion, telefono)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            return $stmt->execute([$nombre, $email, $passwordHash, $rol, $area_id, $ruta_foto, $direccion, $telefono]);

        } catch (PDOException $e) {
            error_log('Error al crear usuario: ' . $e->getMessage());
            return false;
        }
    }

    // 🔍 Obtener todos con área
    public function obtenerTodosConArea() {
        $stmt = $this->conn->prepare("
            SELECT u.*, a.nombre AS nombre_area
            FROM users u
            LEFT JOIN areas a ON u.area_id = a.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $email, $rol, $area_id, $foto_perfil = null, $direccion = '', $telefono = '') {
        $usuario = $this->obtenerPorId($id);
        $ruta_foto = $usuario['foto_perfil']; // conservar la actual por defecto

        if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = uniqid() . "_" . basename($foto_perfil['name']);
            $ruta_foto = 'uploads/' . $nombreArchivo;
            move_uploaded_file($foto_perfil['tmp_name'], __DIR__ . '/../public/' . $ruta_foto);
        }

       $stmt = $this->conn->prepare("
            UPDATE users 
            SET nombre = ?, email = ?, rol = ?, area_id = ?, foto_perfil = ?, direccion = ?, telefono = ?
            WHERE id = ?
        ");
        return $stmt->execute([$nombre, $email, $rol, $area_id, $ruta_foto, $direccion, $telefono, $id]);

    }


    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function obtenerAreas() {
        $stmt = $this->conn->query("SELECT * FROM areas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔁 Recuperar contraseña

    // Buscar usuario por email
    public function buscarPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Guardar token de recuperación
    public function guardarToken($id_usuario, $token, $expiracion) {
        $stmt = $this->conn->prepare("
            UPDATE users SET token = ?, token_expiracion = ? WHERE id = ?
        ");
        return $stmt->execute([$token, $expiracion, $id_usuario]);
    }

    // Buscar usuario por token
    public function buscarPorToken($token) {
        $stmt = $this->conn->prepare("
            SELECT * FROM users WHERE token = ? AND token_expiracion >= NOW() LIMIT 1
        ");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar nueva contraseña
    public function actualizarPassword($id, $nuevaPassword) {
        $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("
            UPDATE users SET password = ?, token = NULL, token_expiracion = NULL WHERE id = ?
        ");
        return $stmt->execute([$hash, $id]);
    }
}
