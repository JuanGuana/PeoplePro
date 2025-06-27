<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Redireccionar si no hay sesión
        if (!isset($_SESSION['usuario_id'])) {
            $this->redirect('/peoplepro/public/index.php?action=login');
        }

        // Pasar variables de sesión a la vista
        $nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
        $rol = $_SESSION['usuario_rol'] ?? 'desconocido';

        $this->view('dashboard/index', ['nombre' => $nombre, 'rol' => $rol]);
    }
}
