<?php
require_once __DIR__ . '/../core/Controller.php';

class LogoutController extends Controller {
    public function index() {
        // Iniciar sesión si no está activa
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Destruir sesión
        session_unset();
        session_destroy();

        // Redirigir al landing
        $this->redirect('/peoplepro/public/index.php?action=landing');
    }
}
