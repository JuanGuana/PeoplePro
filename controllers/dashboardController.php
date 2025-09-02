<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Capacitacion.php';
require_once __DIR__ . '/../models/Beneficio.php';
require_once __DIR__ . '/../models/Dashboard.php';

require_once __DIR__ . '/../models/Capacitacion.php';
require_once __DIR__ . '/../models/Beneficio.php';
require_once __DIR__ . '/../models/Dashboard.php';

class DashboardController extends Controller {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->requireLogin();
    }

    public function index() {
        $nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
        $rol = $_SESSION['usuario_rol'] ?? 'desconocido';

        // Modelos de listados
        $capacitacionModel = new Capacitacion();
        $capacitaciones = $capacitacionModel->obtenerTodos();

        $beneficioModel = new Beneficio();
        $beneficios = $beneficioModel->obtenerTodos();

        // Modelo de estadísticas
        $dashboardModel = new Dashboard();
        $stats = [
            'visitantes_hoy'     => $dashboardModel->visitantesHoy(),
            'visitantes_semana'  => $dashboardModel->visitantesSemana(),
            'visitantes_mes'     => $dashboardModel->visitantesMes(),
            'usuarios_activos'   => $dashboardModel->usuariosActivos(),
            'empleados_por_area' => $dashboardModel->empleadosPorArea(),
            'permisos_pendientes'=> $dashboardModel->permisosPendientes()
        ];

        // Pasar todo a la vista
        $this->view('dashboard/index', [
            'nombre'         => $nombre,
            'rol'            => $rol,
            'capacitaciones' => $capacitaciones,
            'beneficios'     => $beneficios,
            'stats'          => $stats
        ]);
    }
}

