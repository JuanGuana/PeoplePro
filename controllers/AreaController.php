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
            $data['mensaje'] = $_SESSION['mensaje'] ?? null;
            unset($_SESSION['mensaje']);
            $this->view('areas/index', $data);
        } else {
            // Si es empleado, lo mandamos a su vista específica
            $this->redirect('/peoplepro/public/index.php?action=area&method=miArea');
        }
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para crear áreas.";
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }
        $this->view('areas/crear');
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Admin') {
            if ($this->area->guardar($_POST)) {
                $_SESSION['mensaje'] = "✅ Área creada exitosamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al crear el área.";
            }
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para editar áreas.";
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }

        $area = $this->area->obtenerPorId($id);
        if (!$area) {
            $_SESSION['mensaje'] = "❌ Área no encontrada.";
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }
        $this->view('areas/editar', ['area' => $area]);
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SESSION['usuario_rol'] === 'Admin') {
            if ($this->area->actualizar($_POST)) {
                $_SESSION['mensaje'] = "✅ Área actualizada correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al actualizar el área.";
            }
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            if ($this->area->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Área eliminada correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al eliminar el área.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar áreas.";
        }
        $this->redirect('/peoplepro/public/index.php?action=area');
    }

    public function detalle($id) {
        $area = $this->area->obtenerPorId($id);

        if (!$area) {
            $_SESSION['mensaje'] = "❌ Área no encontrada.";
            $this->redirect('/peoplepro/public/index.php?action=area');
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
            $_SESSION['mensaje'] = "⚠️ No tienes un área asignada en la sesión.";
            $this->redirect('/peoplepro/public/index.php?action=area');
            return;
        }

        $area = $this->area->obtenerPorId($areaId);

        if (!$area) {
            $_SESSION['mensaje'] = "⚠️ Área no encontrada.";
            $this->redirect('/peoplepro/public/index.php?action=area');
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
