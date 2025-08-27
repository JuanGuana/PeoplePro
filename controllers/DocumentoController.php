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
    $filtrar_usuario_id = isset($_GET['usuario_id']) ? intval($_GET['usuario_id']) : null;
    $usuario_filtrado = null;

    if ($rol === 'admin') {
        if ($filtrar_usuario_id) {
            $documentos = $this->documento->obtenerPorUsuario($filtrar_usuario_id);
            $usuario_filtrado = $this->documento->obtenerNombreUsuario($filtrar_usuario_id);
            $usuarios = [];
        } else {
            $documentos = [];
            $usuarios = $this->documento->obtenerUsuariosConDocumentos();
        }
    } else {
        $documentos = $this->documento->obtenerPorUsuario($usuario_id);
        $usuarios = [];
    }

    $this->view('documentos/index', [
        'documentos' => $documentos,
        'rol' => $rol,
        'usuario_filtrado' => $usuario_filtrado,
        'usuarios' => $usuarios
    ]);
}

    public function crear() {
        if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'usuario') {
            $_SESSION['error'] = 'No tienes permisos para crear documentos.';
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        $this->view('documentos/crear');
    }

    public function guardar() {
        if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'usuario') {
            $_SESSION['error'] = 'No tienes permisos para guardar documentos.';
            $this->redirect('/peoplepro/public/index.php?action=documento');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'] ?? null;
            $nombre = trim(htmlspecialchars($_POST['nombre'] ?? ''));
            $archivo = $_FILES['archivo']['name'] ?? '';
            $tmp_name = $_FILES['archivo']['tmp_name'] ?? '';
            $error = $_FILES['archivo']['error'] ?? UPLOAD_ERR_NO_FILE;

            // Validación de datos
            if (!$usuario_id || empty($nombre) || $error !== UPLOAD_ERR_OK) {
                $_SESSION['error'] = 'Datos inválidos o archivo no subido.';
                $this->redirect('/peoplepro/public/index.php?action=documento');
                return;
            }

            // Renombrar archivo para evitar duplicados
            $extension = pathinfo($archivo, PATHINFO_EXTENSION);
            $nuevoNombre = uniqid('doc_', true) . '.' . $extension;
            $ruta = 'uploads/' . $nuevoNombre;

            // Validar tipo de archivo (ejemplo: solo PDF y DOCX)
            $permitidos = ['pdf', 'doc', 'docx'];
            if (!in_array(strtolower($extension), $permitidos)) {
                $_SESSION['error'] = 'Tipo de archivo no permitido.';
                $this->redirect('/peoplepro/public/index.php?action=documento');
                return;
            }

            // Subir archivo
            if (move_uploaded_file($tmp_name, __DIR__ . '/../' . $ruta)) {
                $this->documento->crear($nombre, $ruta, $usuario_id);
            } else {
                $_SESSION['error'] = 'Error al subir el archivo.';
            }

            $this->redirect('/peoplepro/public/index.php?action=documento');
        }
    }

    public function eliminar($id) {
        if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin') {
            $this->documento->eliminar($id);
        } else {
            $_SESSION['error'] = 'No tienes permisos para eliminar documentos.';
        }
        $this->redirect('/peoplepro/public/index.php?action=documento');
    }
}