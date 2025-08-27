<?php
require_once __DIR__ . '/../core/Controller.php';

class VisitanteController extends Controller
{
    private $visitanteModel;

    public function __construct()
    {
       if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin(); // 🔐 Protege todas las acciones
        $this->visitanteModel = $this->model('Visitante');
    }

    public function index()
    {
        $this->requireLogin();
        $visitantes = $this->visitanteModel->obtenerTodos();
        $this->view('visitantes/index', ['visitantes' => $visitantes]);
    }

    public function crear()
    {
        $this->view('visitantes/crear');
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $documento = trim($_POST['documento'] ?? '');
            $empresa = trim($_POST['empresa'] ?? '');
            $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
            $fecha_salida = $_POST['fecha_salida'] ?? '';
            $motivo = trim($_POST['motivo'] ?? '');

            $this->visitanteModel->insertar($nombre, $documento, $empresa, $fecha_ingreso, $fecha_salida, $motivo);
        }

        // Redirección corregida
        $this->redirect('index.php?action=visitante&method=index');
    }

    public function editar($id = null)
    {
        if (!is_numeric($id)) {
            return $this->redirect('index.php?action=visitante&method=index');
        }

        $visitante = $this->visitanteModel->obtenerPorId($id);
        if (!$visitante) {
            return $this->redirect('index.php?action=visitante&method=index');
        }

        $this->view('visitantes/editar', ['visitante' => $visitante]);
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!is_numeric($id)) {
                return $this->redirect('index.php?action=visitante&method=index');
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $documento = trim($_POST['documento'] ?? '');
            $empresa = trim($_POST['empresa'] ?? '');
            $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
            $fecha_salida = $_POST['fecha_salida'] ?? '';
            $motivo = trim($_POST['motivo'] ?? '');

            $this->visitanteModel->actualizar($id, $nombre, $documento, $empresa, $fecha_ingreso, $fecha_salida, $motivo);
        }

        $this->redirect('index.php?action=visitante&method=index');
    }

    public function eliminar($id = null)
    {
        if (is_numeric($id)) {
            $this->visitanteModel->eliminar($id);
        }

        $this->redirect('index.php?action=visitante&method=index');
    }
}

