<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Documento.php';

class DocumentoController extends Controller {
    private $documento;

    public function __construct() {
        $this->documento = new Documento();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function index() {
        $rol = $_SESSION['usuario_rol'] ?? '';
        $usuario_id = $_SESSION['usuario_id'] ?? null;

        if ($rol === 'admin') {
            $documentos = $this->documento->obtenerTodosConUsuario();
        } else {
            $documentos = $this->documento->obtenerPorUsuario($usuario_id);
        }

        $this->view('documentos/index', ['documentos' => $documentos, 'rol' => $rol]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'usuario') {
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        $this->view('documentos/crear');
    }

    public function guardar() {
        if ($_SESSION['usuario_rol'] !== 'usuario') {
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = $_POST['nombre'];
            $archivo = $_FILES['archivo']['name'];
            $ruta = 'uploads/' . $archivo;

            if (move_uploaded_file($_FILES['archivo']['tmp_name'], __DIR__ . '/../' . $ruta)) {
                $this->documento->crear($nombre, $ruta, $usuario_id);
            }

            $this->redirect('/peoplepro/public/index.php?action=documento');
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'admin') {
            $this->documento->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=documento');
    }
}
