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
        $this->view('beneficios/index', ['beneficios' => $beneficios]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
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
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin'],
                'imagen' => $imagen
            ];

            if ($this->model->crear($data)) {
                $this->redirect('/peoplepro/public/index.php?action=beneficio');
            } else {
                echo "Error al crear la beneficio.";
            }
        } else {
            $this->view('beneficios/crear');
        }
    }

    public function editar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
            return;
        }
        if ($id === null) {
            $this->redirect('/peoplepro/public/index.php?action=beneficio');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $beneficio = $this->model->obtenerPorId($id);
            if (!$beneficio) {
                $this->redirect('/peoplepro/public/index.php?action=beneficio');
            }

            $imagen = $beneficio['imagen']; // Imagen anterior por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $tmpFilePath = $_FILES['imagen']['tmp_name'];

                $upload = new UploadApi();
                $result = $upload->upload($tmpFilePath);

                $imagen = $result['secure_url']; // nueva URL en Cloudinary
            }


            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin'],
                'imagen' => $imagen
            ];

            if ($this->model->actualizar($id, $data)) {
                $this->redirect('/peoplepro/public/index.php?action=beneficio');
            } else {
                echo "Error al actualizar beneficio.";
            }
        } else {
        $beneficio = $this->model->obtenerPorId($id);
        $this->view('beneficios/editar', ['beneficio' => $beneficio]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $this->model->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=beneficio');
    }
}
