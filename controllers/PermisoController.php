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

        $this->view('permisos/index', [
            'permisos' => $data,
            'mensaje'  => $_SESSION['mensaje'] ?? null
        ]);
        unset($_SESSION['mensaje']);
    }

    public function solicitud() {
        if ($_SESSION['usuario_rol'] !== 'Empleado') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para solicitar permisos.";
            $this->redirect('/peoplepro/public/index.php?action=permiso');
            return;
        }

        $this->view('permisos/solicitar', [
            'mensaje' => $_SESSION['mensaje'] ?? null
        ]);
        unset($_SESSION['mensaje']);
    }

    public function guardarSolicitud() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Empleado') {
            $tipo = $_POST['tipo'] ?? '';
            $fecha_inicio = $_POST['fecha_inicio'] ?? null;
            $fecha_fin = $_POST['fecha_fin'] ?? null;
            $usuario_id = $_SESSION['usuario_id'];

            $permiso = $this->model('Permiso');

            if ($permiso->crear($tipo, $usuario_id, 'pendiente', $fecha_inicio, $fecha_fin)) {
                $_SESSION['mensaje'] = "✅ Solicitud de permiso enviada correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo registrar la solicitud de permiso.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ Acción no permitida.";
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function actualizarEstado($id, $estado) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $permiso = $this->model('Permiso');

            if ($permiso->actualizarEstado($id, $estado)) {
                $_SESSION['mensaje'] = "✅ Estado del permiso actualizado a <b>$estado</b>.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo actualizar el estado del permiso.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para realizar esta acción.";
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $permiso = $this->model('Permiso');

            if ($permiso->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Permiso eliminado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo eliminar el permiso.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar permisos.";
        }

        $this->redirect('/peoplepro/public/index.php?action=permiso');
    }
}
