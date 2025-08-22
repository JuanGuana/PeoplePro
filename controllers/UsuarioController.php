<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new Usuario();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->requireLogin();
    }

    public function index() {
        $usuarios = $this->userModel->obtenerTodosConArea();
        $areas = $this->userModel->obtenerAreas();
        $this->view('usuarios/index', ['usuarios' => $usuarios, 'areas' => $areas]);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $password = $_POST['password'] ?? '';
            $rol = $_POST['rol'] ?? 'usuario';
            $area_id = $_POST['area_id'] ?? null;

            $this->userModel->crear(
                $nombre, $email, $password, $rol, $area_id, $direccion, $telefono
            );

            header('Location: /peoplepro/public/index.php?action=usuario');
            exit;
        } else {
            $areas = $this->userModel->obtenerAreas();
            $this->view('usuarios/crear', ['areas' => $areas]);
        }
    }

    public function editar($id) {
        $usuario = $this->userModel->obtenerPorId($id);
        $areas = $this->userModel->obtenerAreas();

        if (!$usuario) {
            header('Location: /peoplepro/public/index.php?action=usuario');
            exit;
        }

        $this->view('usuarios/editar', ['usuario' => $usuario, 'areas' => $areas]);
    }

    public function actualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idSesion = $_SESSION['usuario']['id'];

            if ($id == $idSesion) {
                // Edición de perfil propio
                $email = $_POST['email'] ?? '';
                $direccion = $_POST['direccion'] ?? '';
                $telefono = $_POST['telefono'] ?? '';

                $usuarioActual = $this->userModel->obtenerPorId($id);
                $nombre = $usuarioActual['nombre'];
                $rol = $usuarioActual['rol'];
                $area_id = $usuarioActual['area_id'];

                $this->userModel->actualizar(
                    $id, $nombre, $email, $rol, $area_id, $direccion, $telefono
                );

                // Refrescar datos de sesión
                $_SESSION['usuario'] = $this->userModel->obtenerPorId($id);

                    header('Location: /peoplepro/public/index.php?action=dashboard');
                exit;

            } else {
                // Admin editando otro usuario
                $nombre = $_POST['nombre'] ?? '';
                $email = $_POST['email'] ?? '';
                $direccion = $_POST['direccion'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $rol = $_POST['rol'] ?? 'usuario';
                $area_id = $_POST['area_id'] ?? null;

                $this->userModel->actualizar(
                    $id, $nombre, $email, $rol, $area_id, $direccion, $telefono
                );

                    header('Location: /peoplepro/public/index.php?action=dashboard');

                exit;
            }
        }
}

    public function eliminar($id) {
        $this->userModel->eliminar($id);
        header('Location: /peoplepro/public/index.php?action=usuario');
        exit;
    }

}

