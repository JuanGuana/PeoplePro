<?php
require_once __DIR__ . '/../models/Permiso.php';

class DashboardController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['usuario_id'])) {
            $this->redirect('index.php?action=login');
        }

        $usuarioModel = new Usuario();
        $permisoModel = new Permiso();
        $visitanteModel = new Visitante();
        $beneficioModel = new Beneficio();

        $totalUsuarios = $usuarioModel->contarUsuarios();
        $totalPermisos = $permisoModel->contarPermisos();
        $totalVisitantes = $visitanteModel->contarVisitantesHoy(); // si lo tienes
        $totalBeneficios = $beneficioModel->contarBeneficios();    // si lo tienes

        $this->view('dashboard/index', [
            'totalUsuarios' => $totalUsuarios,
            'totalPermisos' => $totalPermisos,
            'totalVisitantes' => $totalVisitantes,
            'totalBeneficios' => $totalBeneficios
        ]);
    }
}
