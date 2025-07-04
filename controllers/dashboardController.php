<?php
require_once __DIR__ . '/../core/Controller.php';

class DashboardController extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin(); // Protege el controlador
    }

    public function index() {
        $nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
        $rol = $_SESSION['usuario_rol'] ?? 'desconocido';

        $this->view('dashboard/index', ['nombre' => $nombre, 'rol' => $rol]);
    }
}
