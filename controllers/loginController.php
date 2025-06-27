<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class LoginController extends Controller {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $resultado = $this->usuario->login($email, $password);

            if (isset($resultado['usuario'])) {
                if (session_status() === PHP_SESSION_NONE) session_start();

                // ✅ Guardar datos del usuario en la sesión
                $_SESSION['usuario_id'] = $resultado['usuario']['id'];
                $_SESSION['usuario_nombre'] = $resultado['usuario']['nombre'];
                $_SESSION['usuario_rol'] = $resultado['usuario']['rol']; // ← necesario para dashboard

                // Redirigir al dashboard
                $this->redirect('/peoplepro/public/index.php?action=dashboard');
            } else {
                // Si las credenciales son incorrectas
                $error = $resultado['error'];
                $this->view('login/index', ['error' => $error]);
            }
        } else {
            // Mostrar formulario de login
            $this->view('login/index');
        }
    }
}
