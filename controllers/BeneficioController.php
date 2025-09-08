<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Beneficio.php';
require_once __DIR__ . '/../config/cloudinary.php';

use Cloudinary\Api\Upload\UploadApi;

class BeneficioController extends Controller {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
        $this->model = new Beneficio();
    }

    public function index() {
        $beneficios = $this->model->obtenerTodos();

        $mensaje = $_SESSION['mensaje'] ?? null;
        unset($_SESSION['mensaje']);

        $this->view('beneficios/index', [
            'beneficios' => $beneficios,
            'mensaje'    => $mensaje
        ]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para crear beneficios.";
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
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
                'nombre'       => $_POST['nombre'],
                'descripcion'  => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin'    => $_POST['fecha_fin'],
                'imagen'       => $imagen
            ];

            if ($this->model->crear($data)) {
                $_SESSION['mensaje'] = "✅ Beneficio creado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al crear el beneficio.";
            }

            $this->redirect('/peoplepro/public/index.php?action=beneficio');
        } else {
            $this->view('beneficios/crear');
        }
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para editar beneficios.";
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        if ($id === null) {
            $_SESSION['mensaje'] = "❌ ID de beneficio inválido.";
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beneficio = $this->model->obtenerPorId($id);
            if (!$beneficio) {
                $_SESSION['mensaje'] = "❌ Beneficio no encontrado.";
                $this->redirect('/peoplepro/public/index.php?action=beneficio');
                return;
            }

            $imagen = $beneficio['imagen']; // Imagen anterior por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['imagen']['tmp_name'];

                $upload = new UploadApi();
                $result = $upload->upload($tmpFilePath);

                $imagen = $result['secure_url']; // nueva URL en Cloudinary
            }

            $data = [
                'nombre'       => $_POST['nombre'],
                'descripcion'  => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin'    => $_POST['fecha_fin'],
                'imagen'       => $imagen
            ];

            if ($this->model->actualizar($id, $data)) {
                $_SESSION['mensaje'] = "✅ Beneficio actualizado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al actualizar el beneficio.";
            }

            $this->redirect('/peoplepro/public/index.php?action=beneficio');
        } else {
            $beneficio = $this->model->obtenerPorId($id);
            if (!$beneficio) {
                $_SESSION['mensaje'] = "❌ Beneficio no encontrado.";
                $this->redirect('/peoplepro/public/index.php?action=beneficio');
                return;
            }

            $this->view('beneficios/editar', ['beneficio' => $beneficio]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            if ($this->model->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Beneficio eliminado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ Error al eliminar el beneficio.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar beneficios.";
        }

        $this->redirect('/peoplepro/public/index.php?action=beneficio');
    }
}
