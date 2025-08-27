<?php
require_once __DIR__ . '/../core/Controller.php';

class PermisoController extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin(); // 🔐 Protege todo el controlador
    }

    public function index() {
        $permiso = $this->model('Permiso');

        if ($_SESSION['usuario_rol'] === 'Empleado') {
            $data = $permiso->obtenerPorUsuario($_SESSION['usuario_id']);
        } else {
            $data = $permiso->obtenerTodos();
        }

        $this->view('permisos/index', ['permisos' => $data]);
    }

    public function solicitud() {
        if ($_SESSION['usuario_rol'] !== 'Empleado') {
            $this->redirect('/peoplepro/public/index.php?action=permiso');
            return;
        }

        $this->view('permisos/solicitar');
    }

    public function guardarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Empleado') {
            $tipo = $_POST['tipo'];
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $usuario_id = $_SESSION['usuario_id'];

            $permiso = $this->model('Permiso');
            $permiso->crear($tipo, $usuario_id, 'pendiente', $fecha_inicio, $fecha_fin);
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function actualizarEstado($id, $estado) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $permiso = $this->model('Permiso');
            $permiso->actualizarEstado($id, $estado);
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $permiso = $this->model('Permiso');
            $permiso->eliminar($id);
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }
}
