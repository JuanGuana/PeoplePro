<?php
require_once __DIR__ . '/../models/Capacitacion.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../config/cloudinary.php'; // carga la config
use Cloudinary\Api\Upload\UploadApi;

class CapacitacionController extends Controller {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
        $this->model = new Capacitacion();
    }

    public function index() {
        $data['capacitaciones'] = $this->model->obtenerTodos();
        $data['mensaje'] = $_SESSION['mensaje'] ?? null;
        unset($_SESSION['mensaje']);

        $this->view('capacitaciones/index', $data);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para crear capacitaciones.";
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagen = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['imagen']['tmp_name'];

                $upload = new UploadApi();
                $result = $upload->upload($tmpFilePath);

                $imagen = $result['secure_url']; // guardamos la URL de Cloudinary
            }

            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'imagen_capacitacion' => $imagen
            ];

            if ($this->model->crear($data)) {
                $_SESSION['mensaje'] = "✅ Capacitación creada correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al crear la capacitación.";
            }

            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
        } else {
            $this->view('capacitaciones/crear');
        }
    }

    public function editar($id = null) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para editar capacitaciones.";
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($id === null) {
            $_SESSION['mensaje'] = "❌ ID de capacitación inválido.";
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $capacitacion = $this->model->obtenerPorId($id);
            if (!$capacitacion) {
                $_SESSION['mensaje'] = "❌ Capacitación no encontrada.";
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
                return;
            }

            $imagen = $capacitacion['imagen_capacitacion']; // Imagen anterior por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['imagen']['tmp_name'];

                $upload = new UploadApi();
                $result = $upload->upload($tmpFilePath);

                $imagen = $result['secure_url']; // nueva URL en Cloudinary
            }

            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'imagen_capacitacion' => $imagen
            ];

            if ($this->model->actualizar($id, $data)) {
                $_SESSION['mensaje'] = "✅ Capacitación actualizada correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al actualizar la capacitación.";
            }

            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
        } else {
            $capacitacion = $this->model->obtenerPorId($id);
            if (!$capacitacion) {
                $_SESSION['mensaje'] = "❌ Capacitación no encontrada.";
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
                return;
            }
            $this->view('capacitaciones/editar', ['capacitacion' => $capacitacion]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar capacitaciones.";
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($this->model->eliminar($id)) {
            $_SESSION['mensaje'] = "🗑️ Capacitación eliminada correctamente.";
        } else {
            $_SESSION['mensaje'] = "❌ Error al eliminar la capacitación.";
        }

        $this->redirect('/peoplepro/public/index.php?action=capacitacion');
    }
}
