<?php
require_once __DIR__ . '/../models/Horario.php';

class HorarioController {
    private $model;

    public function __construct() {
        $this->model = new Horario();
    }

    public function index() {
        $horarios = $this->model->obtenerTodos();
        $this->view('horarios/index', ['horarios' => $horarios]);
    }

    public function crear() {
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
                header('Location: /peoplepro/public/horario/index');
                exit;
            } else {
                echo "Error al crear el horario.";
            }
        } else {
            $data['usuarios'] = $this->model->obtenerUsuarios();
            $this->view('horarios/crear', $data);
        }
    }

    public function editar($id = null) {
        if ($id === null) {
            header('Location: /peoplepro/public/horario/index');
            exit;
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

            if ($this->model->actualizar($id, $data)) {
                header('Location: /peoplepro/public/horario/index');
                exit;
            } else {
                echo "Error al actualizar el horario.";
            }
        } else {
            $horario = $this->model->obtenerPorId($id);
            $usuarios = $this->model->obtenerUsuarios();
            if (!$horario) {
                header('Location: /peoplepro/public/horario/index');
                exit;
            }
            $this->view('horarios/editar', [
                'horario' => $horario,
                'usuarios' => $usuarios
            ]);
        }
    }

    public function eliminar($id) {
        if ($this->model->eliminar($id)) {
            header('Location: /peoplepro/public/horario/index');
            exit;
        } else {
            echo "Error al eliminar el horario.";
        }
    }

    private function view($vista, $data = []) {
        extract($data);
        require_once "../views/$vista.php";
    }
}
