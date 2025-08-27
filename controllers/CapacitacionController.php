<?php
require_once __DIR__ . '/../models/Capacitacion.php';
require_once __DIR__ . '/../core/Controller.php';

class CapacitacionController extends Controller {
    private $model;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
        $this->model = new Capacitacion();
    }

    public function index() {
        $data['capacitaciones'] = $this->model->obtenerTodos();
        $this->view('capacitaciones/index', $data);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagen = null;
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $rutaDestino = 'public/img/capacitaciones/' . $nombreArchivo;
                move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../' . $rutaDestino);
                $imagen = $rutaDestino;
            }

            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'imagen_capacitacion' => $imagen
            ];

            if ($this->model->crear($data)) {
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            } else {
                echo "Error al crear la capacitación.";
            }
        } else {
            $this->view('capacitaciones/crear');
        }
    }

    public function editar($id = null) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($id === null) {
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $capacitacion = $this->model->obtenerPorId($id);
            if (!$capacitacion) {
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            }

            $imagen = $capacitacion['imagen_capacitacion']; // Imagen anterior por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
                $rutaDestino = 'public/img/capacitaciones/' . $nombreArchivo;
                move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . '/../' . $rutaDestino);
                $imagen = $rutaDestino;
            }

            $data = [
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'imagen_capacitacion' => $imagen
            ];

            if ($this->model->actualizar($id, $data)) {
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            } else {
                echo "Error al actualizar la capacitación.";
            }
        } else {
            $capacitacion = $this->model->obtenerPorId($id);
            if (!$capacitacion) {
                $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            }
            $this->view('capacitaciones/editar', ['capacitacion' => $capacitacion]);
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] !== 'Admin') {
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
            return;
        }

        if ($this->model->eliminar($id)) {
            $this->redirect('/peoplepro/public/index.php?action=capacitacion');
        } else {
            echo "Error al eliminar la capacitación.";
        }
    }
}
