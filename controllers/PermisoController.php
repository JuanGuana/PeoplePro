<?php
require_once __DIR__ . '/../core/Controller.php';

class PermisoController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $permiso = $this->model('Permiso');

        if ($_SESSION['usuario_rol'] === 'usuario') {
            $data = $permiso->obtenerPorUsuario($_SESSION['usuario_id']);
        } else {
            $data = $permiso->obtenerTodos();
        }

        $this->view('permisos/index', ['permisos' => $data]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=permiso');
            return;
        }

        $usuarios = $this->model('Usuario')->obtenerTodos();
        $this->view('permisos/crear', ['usuarios' => $usuarios]);
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'admin') {
            $tipo = $_POST['tipo'];
            $usuario_id = $_POST['usuario_id'];
            $permiso = $this->model('Permiso');
            $permiso->crear($tipo, $usuario_id, 'Aprobado');
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function solicitud() {
        if ($_SESSION['usuario_rol'] !== 'usuario') {
            $this->redirect('/peoplepro/public/index.php?action=permiso');
            return;
        }

        $this->view('permisos/solicitar');
    }

    public function guardarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'usuario') {
            $tipo = $_POST['tipo'];
            $usuario_id = $_SESSION['usuario_id'];
            $permiso = $this->model('Permiso');
            $permiso->crear($tipo, $usuario_id); // Estado por defecto: Pendiente
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function actualizarEstado($id, $estado) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $permiso = $this->model('Permiso');
            $permiso->actualizarEstado($id, $estado);
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $permiso = $this->model('Permiso');
            $permiso->eliminar($id);
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }
}
