<?php
require_once __DIR__ . '/../core/Controller.php';

class LandingController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['usuario_id'])) {
            // Si el usuario ya inició sesión, redirige al dashboard
            $this->redirect('/peoplepro/public/index.php?action=dashboard');
            return;
        }

        $this->view('landing/index');
    }
}
