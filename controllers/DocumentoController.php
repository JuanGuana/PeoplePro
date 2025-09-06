<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Documento.php';

class DocumentoController extends Controller {
    private $documento;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
        $this->documento = new Documento();
    }

    public function index() {
        $rol = $_SESSION['usuario_rol'] ?? '';
        $usuario_id = $_SESSION['usuario_id'] ?? null;

        if ($rol === 'Admin') {
            $documentos = $this->documento->obtenerTodosConUsuario();
        } else {
            $documentos = $this->documento->obtenerPorUsuario($usuario_id);
        }

        $this->view('documentos/index', ['documentos' => $documentos, 'rol' => $rol]);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Empleado') {
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        $this->view('documentos/crear');
    }

    public function guardar() {
        if ($_SESSION['usuario_rol'] !== 'Empleado' && $_SESSION['usuario_rol'] !== 'Seguridad') {
            echo "<script>alert('No tienes permisos para subir documentos'); window.history.back();</script>";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = trim($_POST['nombre'] ?? '');

            if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
                echo "<script>alert('Error al subir el archivo'); window.history.back();</script>";
                return;
            }

            $maxSize = 5 * 1024 * 1024; // 5 MB
            $fileTmp  = $_FILES['archivo']['tmp_name'];
            $fileName = basename($_FILES['archivo']['name']);
            $fileSize = $_FILES['archivo']['size'];
            $fileType = mime_content_type($fileTmp);

            // Validar tamaño
            if ($fileSize > $maxSize) {
                echo "<script>alert('El archivo es demasiado grande. Máximo permitido: 5 MB'); window.history.back();</script>";
                return;
            }

            // Validar tipo (solo PDF)
            if ($fileType !== 'application/pdf') {
                echo "<script>alert('Solo se permiten archivos PDF'); window.history.back();</script>";
                return;
            }

            // Guardar con nombre único
            $ruta = 'uploads/' . time() . '_' . $fileName;

            if (move_uploaded_file($fileTmp, __DIR__ . '/../' . $ruta)) {
                $this->documento->crear($nombre, $ruta, $usuario_id);
                echo "<script>alert('Documento subido correctamente'); window.location.href='/peoplepro/public/index.php?action=documento';</script>";
            } else {
                echo "<script>alert('No se pudo guardar el archivo'); window.history.back();</script>";
            }
        }
    }


    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            $this->documento->eliminar($id);
        }
        $this->redirect('/peoplepro/public/index.php?action=documento');
    }
}
