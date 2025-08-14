<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Capacitacion.php';
require_once __DIR__ . '/../models/Beneficio.php';


class DashboardController extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin(); // Protege el controlador
    }

    public function index() {
    $nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
    $rol = $_SESSION['usuario_rol'] ?? 'desconocido';
    $foto_perfil = $_SESSION['usuario_foto_perfil'] ?? 'img/foto_perfil/default.png';


    $capacitacionModel = new Capacitacion();
    $capacitaciones = $capacitacionModel->obtenerTodos(); // o una versión limitada

    $beneficioModel = new Beneficio();
    $beneficios = $beneficioModel->obtenerTodos();

    $this->view('dashboard/index', [
        'nombre' => $nombre,
        'rol' => $rol,
        'capacitaciones' => $capacitaciones,
        'beneficios' => $beneficios,
        'foto_perfil' => $foto_perfil
    ]);
}

}
