<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Area.php';

class AreaController extends Controller {
    private $area;

    public function __construct() {
        $this->area = new Area();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function index() {
        $data['areas'] = $this->area->getAll();
        $this->view('areas/index', $data);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }
        $this->view('areas/crear');
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'admin') {
            $this->area->guardar($_POST);
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'admin') {
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }

        $area = $this->area->obtenerPorId($id);
        if (!$area) {
            echo "Área no encontrada";
            return;
        }
        $this->view('areas/editar', ['area' => $area]);
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'admin') {
            $this->area->actualizar($_POST);
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $this->area->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }
}
