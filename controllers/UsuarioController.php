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

        $this->view('usuarios/index', [
            'usuarios' => $usuarios,
            'areas' => $areas,
            'mensaje' => $_SESSION['mensaje'] ?? null
        ]);
        unset($_SESSION['mensaje']);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $email = $_POST['email'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $password = $_POST['password'] ?? '';
            $rol = $_POST['rol'] ?? 'Empleado';
            $estado = $_POST['estado'] ?? 'activo';
            $area_id = $_POST['area_id'] ?? null;

            if ($this->userModel->crear(
                $nombre, $email, $password, $rol, $area_id, $direccion, $telefono, $estado
            )) {
                $_SESSION['mensaje'] = "✅ Usuario <b>$nombre</b> creado correctamente.";
            } else {
                $_SESSION['mensaje'] = "❌ No se pudo crear el usuario.";
            }

            $this->redirect('/peoplepro/public/index.php?action=usuario');
        } else {
            $areas = $this->userModel->obtenerAreas();
            $this->view('usuarios/crear', ['areas' => $areas]);
        }
    }

    public function editar($id) {
        $usuario = $this->userModel->obtenerPorId($id);
        $areas = $this->userModel->obtenerAreas();

        if (!$usuario) {
            $_SESSION['mensaje'] = "⚠️ Usuario no encontrado.";
            $this->redirect('/peoplepro/public/index.php?action=usuario');
            return;
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

                if ($this->userModel->actualizar(
                    $id, $nombre, $email, $rol, $area_id, $direccion, $telefono
                )) {
                    $_SESSION['usuario'] = $this->userModel->obtenerPorId($id); // refresca sesión
                    $_SESSION['mensaje'] = "✅ Perfil actualizado correctamente.";
                } else {
                    $_SESSION['mensaje'] = "❌ No se pudo actualizar tu perfil.";
                }

                $this->redirect('/peoplepro/public/index.php?action=dashboard');
            } else {
                // Admin editando otro usuario
                $nombre = $_POST['nombre'] ?? '';
                $email = $_POST['email'] ?? '';
                $direccion = $_POST['direccion'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $rol = $_POST['rol'] ?? 'Empleado';
                $area_id = $_POST['area_id'] ?? null;
                $estado = $_POST['estado'] ?? 'activo';

                if ($this->userModel->actualizar(
                    $id, $nombre, $email, $rol, $area_id, $direccion, $telefono, $estado
                )) {
                    $_SESSION['mensaje'] = "✅ Usuario <b>$nombre</b> actualizado correctamente.";
                } else {
                    $_SESSION['mensaje'] = "❌ No se pudo actualizar el usuario.";
                }

                $this->redirect('/peoplepro/public/index.php?action=usuario');
            }
        }
    }

    public function eliminar($id) {
        if ($this->userModel->eliminar($id)) {
            $_SESSION['mensaje'] = "🗑️ Usuario eliminado correctamente.";
        } else {
            $_SESSION['mensaje'] = "❌ No se pudo eliminar el usuario.";
        }

        $this->redirect('/peoplepro/public/index.php?action=usuario');
    }
}
