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

        $data = [
            'documentos' => $documentos,
            'rol' => $rol,
            'mensaje' => $_SESSION['mensaje'] ?? null
        ];
        unset($_SESSION['mensaje']);

        $this->view('documentos/index', $data);
    }

    public function crear() {
        if ($_SESSION['usuario_rol'] !== 'Empleado') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para subir documentos.";
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        $this->view('documentos/crear');
    }

    public function guardar() {
        $rol = $_SESSION['usuario_rol'] ?? '';
        if ($rol !== 'Empleado' && $rol !== 'Seguridad') {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para subir documentos.";
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'];
            $nombre = trim($_POST['nombre'] ?? '');

            if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['mensaje'] = "❌ Error al subir el archivo.";
                $this->redirect('/peoplepro/public/index.php?action=documento');
                return;
            }

            $maxSize = 5 * 1024 * 1024; // 5 MB
            $fileTmp  = $_FILES['archivo']['tmp_name'];
            $fileName = basename($_FILES['archivo']['name']);
            $fileSize = $_FILES['archivo']['size'];
            $fileType = mime_content_type($fileTmp);

            // Validar tamaño
            if ($fileSize > $maxSize) {
                $_SESSION['mensaje'] = "⚠️ El archivo es demasiado grande. Máximo permitido: 5 MB.";
                $this->redirect('/peoplepro/public/index.php?action=documento');
                return;
            }

            // Validar tipo (solo PDF)
            if ($fileType !== 'application/pdf') {
                $_SESSION['mensaje'] = "⚠️ Solo se permiten archivos PDF.";
                $this->redirect('/peoplepro/public/index.php?action=documento');
                return;
            }

            // Guardar con nombre único
            $ruta = 'uploads/' . time() . '_' . $fileName;

            if (move_uploaded_file($fileTmp, __DIR__ . '/../' . $ruta)) {
                $this->documento->crear($nombre, $ruta, $usuario_id);
                $_SESSION['mensaje'] = "✅ Documento subido correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo guardar el archivo.";
            }

            $this->redirect('/peoplepro/public/index.php?action=documento');
        }
    }

    public function eliminar($id) {
        if ($_SESSION['usuario_rol'] === 'Admin') {
            if ($this->documento->eliminar($id)) {
                $_SESSION['mensaje'] = "🗑️ Documento eliminado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo eliminar el documento.";
            }
        } else {
            $_SESSION['mensaje'] = "⚠️ No tienes permisos para eliminar documentos.";
        }

        $this->redirect('/peoplepro/public/index.php?action=documento');
    }
}
