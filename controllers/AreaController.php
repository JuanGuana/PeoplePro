<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Area.php';

class AreaController extends Controller {
    private $area;

    public function __construct() {
        $this->area = new Area();

        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $this->requireLogin();
    }

    public function index() {
        // Si el usuario es admin, ve todas las áreas
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $data['areas'] = $this->area->getAll();
            $this->view('areas/index', $data);
        } else {
            // Si es empleado, lo mandamos a su vista específica
            $this->redirect('/peoplepro/public/index.php?action=area&method=miArea');
        }
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }
        $this->view('areas/crear');
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Admin') {
            $this->area->guardar($_POST);
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Admin') {
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

    public function detalle($id) {
        $area = $this->area->obtenerPorId($id);

        if (!$area) {
            echo "Área no encontrada";
            return;
        }

        require_once __DIR__ . '/../models/Usuario.php';
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->obtenerUsuariosPorArea($id);

        $this->view('areas/detalle', [
            'area' => $area,
            'usuarios' => $usuarios
        ]);
    }
    public function miArea() {
        $areaId = $_SESSION['usuario_area_id'] ?? null;

        if (!$areaId) {
            echo "⚠️ No tienes un área asignada en la sesión.";
            return;
        }

        $area = $this->area->obtenerPorId($areaId);

        if (!$area) {
            echo "⚠️ Área no encontrada.";
            return;
        }

        require_once __DIR__ . '/../models/Usuario.php';
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->obtenerUsuariosPorArea($areaId);

        $this->view('areas/mi_area', [
            'area' => $area,
            'usuarios' => $usuarios
        ]);
    }






}
