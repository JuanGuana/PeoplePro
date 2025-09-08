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
        $visitantes = $this->visitanteModel->obtenerTodos();

        $this->view('visitantes/index', [
            'visitantes' => $visitantes,
            'mensaje' => $_SESSION['mensaje'] ?? null
        ]);
        unset($_SESSION['mensaje']); // limpiar después de mostrar
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

            if ($this->visitanteModel->insertar($nombre, $documento, $empresa, $fecha_ingreso, $fecha_salida, $motivo)) {
                $_SESSION['mensaje'] = "✅ Visitante <b>$nombre</b> registrado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo registrar el visitante.";
            }
        }

        $this->redirect('index.php?action=visitante&method=index');
    }

    public function editar($id = null)
    {
        if (!is_numeric($id)) {
            $_SESSION['mensaje'] = "⚠️ ID de visitante inválido.";
            return $this->redirect('index.php?action=visitante&method=index');
        }

        $visitante = $this->visitanteModel->obtenerPorId($id);
        if (!$visitante) {
            $_SESSION['mensaje'] = "❌ Visitante no encontrado.";
            return $this->redirect('index.php?action=visitante&method=index');
        }

        $this->view('visitantes/editar', ['visitante' => $visitante]);
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!is_numeric($id)) {
                $_SESSION['mensaje'] = "⚠️ ID de visitante inválido.";
                return $this->redirect('index.php?action=visitante&method=index');
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $documento = trim($_POST['documento'] ?? '');
            $empresa = trim($_POST['empresa'] ?? '');
            $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
            $fecha_salida = $_POST['fecha_salida'] ?? '';
            $motivo = trim($_POST['motivo'] ?? '');

            if ($this->visitanteModel->actualizar($id, $nombre, $documento, $empresa, $fecha_ingreso, $fecha_salida, $motivo)) {
                $_SESSION['mensaje'] = "✅ Visitante <b>$nombre</b> actualizado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo actualizar el visitante.";
            }
        }

        $this->redirect('index.php?action=visitante&method=index');
    }

    public function eliminar($id = null)
    {
        if (is_numeric($id)) {
            if ($this->visitanteModel->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Visitante eliminado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo eliminar el visitante.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ ID inválido para eliminar visitante.";
        }

        $this->redirect('index.php?action=visitante&method=index');
    }

    public function marcarSalida($id)
    {
        if (!is_numeric($id)) {
            $_SESSION['mensaje'] = "⚠️ ID inválido para marcar salida.";
            return $this->redirect('index.php?action=visitante&method=index');
        }

        date_default_timezone_set('America/Bogota');
        $fechaSalida = date('Y-m-d H:i:s');

        if ($this->visitanteModel->marcarSalida($id, $fechaSalida)) {
            $_SESSION['mensaje'] = "👋 Se registró la salida del visitante correctamente.";
        } else {
            $_SESSION['mensaje'] = "❌ No se pudo registrar la salida.";
        }

        $this->redirect('index.php?action=visitante&method=index');
    }
}
