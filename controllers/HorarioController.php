<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Horario.php';

class HorarioController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new Horario();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function index() {
        // Si es usuario, solo ve sus propios horarios
        if ($_SESSION['usuario_rol'] === 'usuario') {
            $horarios = $this->model->obtenerPorUsuario($_SESSION['usuario_id']);
        } else {
            $horarios = $this->model->obtenerTodos();
        }

        $this->view('horarios/index', ['horarios' => $horarios]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'admin') {
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
                $this->redirect('/peoplepro/public/index.php?action=horario');
            } else {
                echo "Error al crear el horario.";
            }
        } else {
            $usuarios = $this->model->obtenerUsuarios();
            $this->view('horarios/crear', ['usuarios' => $usuarios]);
        }
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=horario');
            return;
        }

        $horario = $this->model->obtenerPorId($id);
        if (!$horario) {
            $this->redirect('/peoplepro/public/index.php?action=horario');
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
                $this->redirect('/peoplepro/public/index.php?action=horario');
            } else {
                echo "Error al actualizar el horario.";
            }
        } else {
            $usuarios = $this->model->obtenerUsuarios();
            $this->view('horarios/editar', [
                'horario' => $horario,
                'usuarios' => $usuarios
            ]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $this->model->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=horario');
    }
}
