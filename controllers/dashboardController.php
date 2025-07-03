<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Usuario.php';

class DashboardController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['usuario_id'])) {
            $this->redirect('index.php?action=login');
        }

        $usuarioModel = new Usuario();
        $totalUsuarios = $usuarioModel->contarUsuarios();

        $this->view('dashboard/index', [
            'nombre' => $_SESSION['usuario'] ?? 'Invitado',
            'totalUsuarios' => $totalUsuarios
        ]);
    }
}
