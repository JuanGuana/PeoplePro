<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Capacitacion.php';


class DashboardController extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin(); // Protege el controlador
    }

    public function index() {
    $nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
    $rol = $_SESSION['usuario_rol'] ?? 'desconocido';

    $capacitacionModel = new Capacitacion();
    $capacitaciones = $capacitacionModel->obtenerTodos(); // o una versión limitada

    $this->view('dashboard/index', [
        'nombre' => $nombre,
        'rol' => $rol,
        'capacitaciones' => $capacitaciones
    ]);
}

}
