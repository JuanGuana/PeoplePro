<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../helpers/mailer.php'; // para enviar el correo

class LoginController extends Controller {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    // Muestra el login y procesa el intento de login
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $resultado = $this->usuario->autenticar($email, $password);

            if (isset($resultado['usuario'])) {
                if (session_status() === PHP_SESSION_NONE) session_start();

                // ✅ Guardar datos del usuario en la sesión
                $_SESSION['usuario_id'] = $resultado['usuario']['id'];
                $_SESSION['usuario_nombre'] = $resultado['usuario']['nombre'];
                $_SESSION['usuario_rol'] = $resultado['usuario']['rol'];
                
                $this->redirect('/peoplepro/public/index.php?action=dashboard');
            } else {
                $this->view('login/index', ['error' => $resultado['error']]);
            }
        } else {
            // Mostrar formulario de login
            $this->view('login/index');
        }
    }

    // Envía el token de recuperación
    public function enviarToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';

            $usuario = $this->usuario->buscarPorEmail($email);

            if ($usuario) {
                $token = bin2hex(random_bytes(32));
                $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

                $this->usuario->guardarToken($usuario['id'], $token, $expiracion);

                enviarCorreoRecuperacion($email, $token); // función definida en helpers/mailer.php

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

    // Muestra el formulario para escribir nueva contraseña
    public function resetear() {
        $token = $_GET['token'] ?? '';

        if (empty($token)) {
            echo "❌ Token inválido.";
            return;
        }

        $this->view('login/resetear', ['token' => $token]);
    }

    // Actualiza la contraseña en la base de datos
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

    // Cierra sesión
    public function logout() {
        session_start();
        session_destroy();
        $this->redirect('/peoplepro/public/index.php?action=login');
    }
}
