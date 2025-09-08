<?php 
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Horario.php';

class HorarioController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new Horario();
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
    }

    public function index() {
        // Si es usuario, solo ve sus propios horarios
        if ($_SESSION['usuario_rol'] === 'Empleado') {
            $horarios = $this->model->obtenerPorUsuario($_SESSION['usuario_id']);
        } else {
            $horarios = $this->model->obtenerTodos();
        }

        $mensaje = $_SESSION['mensaje'] ?? null;
        unset($_SESSION['mensaje']); // limpiar mensaje después de mostrarlo

        $this->view('horarios/index', [
            'horarios' => $horarios,
            'mensaje'  => $mensaje
        ]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para crear horarios.";
            $this->redirect('/peoplepro/public/index.php?action=horario');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'usuario_id'    => $_POST['usuario_id'] ?? null,
                'fecha'         => $_POST['fecha'] ?? null,
                'fecha_fin'     => $_POST['fecha_fin'] ?? null,
                'hora_inicio'   => $_POST['hora_inicio'] ?? null,
                'hora_fin'      => $_POST['hora_fin'] ?? null,
                'estado'        => $_POST['estado'] ?? 'Activo',
                'observaciones' => $_POST['observaciones'] ?? null
            ];

            if ($this->model->crear($data)) {
                $_SESSION['mensaje'] = "✅ Horario creado exitosamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al crear el horario.";
            }

            $this->redirect('/peoplepro/public/index.php?action=horario');
        } else {
            $usuarios = $this->model->obtenerUsuarios();
            $this->view('horarios/crear', ['usuarios' => $usuarios]);
        }
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para editar horarios.";
            $this->redirect('/peoplepro/public/index.php?action=horario');
            return;
        }

        $horario = $this->model->obtenerPorId($id);
        if (!$horario) {
            $_SESSION['mensaje'] = "❌ El horario no existe.";
            $this->redirect('/peoplepro/public/index.php?action=horario');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'usuario_id'    => $_POST['usuario_id'] ?? null,
                'fecha'         => $_POST['fecha'] ?? null,
                'fecha_fin'     => $_POST['fecha_fin'] ?? null,
                'hora_inicio'   => $_POST['hora_inicio'] ?? null,
                'hora_fin'      => $_POST['hora_fin'] ?? null,
                'estado'        => $_POST['estado'] ?? null,
                'observaciones' => $_POST['observaciones'] ?? null
            ];

            if ($this->model->actualizar($id, $data)) {
                $_SESSION['mensaje'] = "✅ Horario actualizado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al actualizar el horario.";
            }

            $this->redirect('/peoplepro/public/index.php?action=horario');
        } else {
            $usuarios = $this->model->obtenerUsuarios();
            $this->view('horarios/editar', [
                'horario' => $horario,
                'usuarios' => $usuarios
            ]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            if ($this->model->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Horario eliminado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al eliminar el horario.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar horarios.";
        }

        $this->redirect('/peoplepro/public/index.php?action=horario');
    }
}
