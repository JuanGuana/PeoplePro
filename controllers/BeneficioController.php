<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Beneficio.php';

class BeneficioController extends Controller {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
        $this->model = new Beneficio();
    }

    public function index() {
        $beneficios = $this->model->obtenerTodos();
        $this->view('beneficios/index', ['beneficios' => $beneficios]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        $this->view('beneficios/crear');
    }

    public function guardar() {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin']
            ];

            $this->model->crear($data);
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
        }
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        $beneficio = $this->model->obtenerPorId($id);
        $this->view('beneficios/editar', ['beneficio' => $beneficio]);
    }

    public function actualizar($id) {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin']
            ];

            $this->model->actualizar($id, $data);
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $this->model->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=beneficio');
    }
}
