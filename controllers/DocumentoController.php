<?php
require_once '../models/Documento.php';

class DocumentoController
{
    private $documentoModel;

    public function __construct()
    {
        $this->documentoModel = new Documento();
    }

    public function index()
    {
        $documentos = $this->documentoModel->obtenerTodos();
        require_once '../views/documentos/index.php';
    }

    public function crear()
    {
        require_once '../views/documentos/crear.php';
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['titulo'] ?? '';
            $archivo = $_FILES['archivo'] ?? null;

            if ($archivo && $archivo['error'] === UPLOAD_ERR_OK) {
                $nombreArchivo = uniqid() . "_" . basename($archivo['name']);
                $rutaDestino = 'public/uploads/' . $nombreArchivo;

                $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
                if ($extension !== 'pdf') {
                    echo "Solo se permiten archivos PDF.";
                    return;
                }

                try {
                    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                        $this->documentoModel->guardar($nombre, $nombreArchivo);
                        header('Location: index.php?controller=Documento&action=index');
                        exit();
                    } else {
                        echo "Error al subir el archivo.";
                    }
                } catch (Exception $e) {
                    error_log("Error al guardar documento: " . $e->getMessage());
                    echo "Ocurrió un error al guardar el documento.";
                }
            } else {
                echo "Archivo inválido o no enviado.";
            }
        }
    }

    public function eliminar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $doc = $this->documentoModel->buscarPorId($id);
            if ($doc && isset($doc['archivo'])) {
                $rutaArchivo = 'public/uploads/' . $doc['archivo'];
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
            }

            $this->documentoModel->eliminar($id);
        }
        header('Location: index.php?controller=Documento&action=index');
        exit();
    }

    public function editar()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $documento = $this->documentoModel->buscarPorId($id);
            require_once '../views/documentos/editar.php';
        }
    }

    public function actualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombre = $_POST['titulo'] ?? '';
            $archivoNuevo = $_FILES['archivo'] ?? null;

            $documentoExistente = $this->documentoModel->buscarPorId($id);
            $nombreArchivo = $documentoExistente['archivo'];

            if ($archivoNuevo && $archivoNuevo['error'] === UPLOAD_ERR_OK) {
                $nuevoNombre = uniqid() . "_" . basename($archivoNuevo['name']);
                $rutaDestino = 'public/uploads/' . $nuevoNombre;

                $extension = strtolower(pathinfo($nuevoNombre, PATHINFO_EXTENSION));
                if ($extension !== 'pdf') {
                    echo "Solo se permiten archivos PDF.";
                    return;
                }

                try {
                    if (move_uploaded_file($archivoNuevo['tmp_name'], $rutaDestino)) {
                        // Eliminar archivo viejo
                        $archivoViejo = 'public/uploads/' . $nombreArchivo;
                        if (file_exists($archivoViejo)) {
                            unlink($archivoViejo);
                        }
                        $nombreArchivo = $nuevoNombre;
                    }
                } catch (Exception $e) {
                    error_log("Error al subir nuevo archivo: " . $e->getMessage());
                }
            }

            $this->documentoModel->actualizar($id, $nombre, $nombreArchivo);
            header('Location: index.php?controller=Documento&action=index');
            exit();
        }
    }
}
