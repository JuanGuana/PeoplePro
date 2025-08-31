<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../helpers/mailer.php'; // para enviar el correo

class LoginController extends Controller {
    private $usuario;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->usuario = new Usuario();
    }

    public function index() {
        if (isset($_SESSION['usuario_id'])) {
            $this->redirect('/peoplepro/public/index.php?action=dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $this->view('login/index', ['error' => 'Debes llenar todos los campos.']);
                return;
            }

            $resultado = $this->usuario->autenticar($email, $password);

        if (isset($resultado['usuario'])) {
            $_SESSION['usuario_id'] = $resultado['usuario']['id'];
            $_SESSION['usuario_nombre'] = $resultado['usuario']['nombre'];
            $_SESSION['usuario_rol'] = $resultado['usuario']['rol'];
            $_SESSION['usuario_area_id'] = $resultado['usuario']['area_id'];
            
            $this->redirect('/peoplepro/public/index.php?action=dashboard');
        }else {
                $this->view('login/index', ['error' => $resultado['error']]);
            }
        } else {
            $this->view('login/index');
        }
    }

    public function enviarToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $usuario = $this->usuario->buscarPorEmail($email);

            if ($usuario) {
                $token = bin2hex(random_bytes(32));
                $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $this->usuario->guardarToken($usuario['id'], $token, $expiracion);
                enviarCorreoRecuperacion($email, $token);

                $this->view('login/index', [
                    'mensaje' => '📧 Se envió un enlace de recuperación a tu correo.'
                ]);
            } else {
                $this->view('login/index', [
                    'error' => '❌ El correo no está registrado en el sistema.'
                ]);
            }
        }
    }

    public function resetear() {
        $token = $_GET['token'] ?? '';

        if (!preg_match('/^[a-f0-9]{64}$/', $token)) {
            echo "❌ Token inválido.";
            return;
        }

        $this->view('login/resetear', ['token' => $token]);
    }

    public function actualizarPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';
            $nuevaPassword = $_POST['password'] ?? '';

            $usuario = $this->usuario->buscarPorToken($token);

            if ($usuario) {
                $this->usuario->actualizarPassword($usuario['id'], $nuevaPassword);

                $this->view('login/index', [
                    'mensaje' => '✅ Contraseña actualizada correctamente. Ahora puedes iniciar sesión.'
                ]);
            } else {
                $this->view('login/index', [
                    'error' => '❌ Token inválido o expirado.'
                ]);
            }
        }
    }
}
