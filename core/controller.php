<?php

// core/Controller.php
class Controller {
    public function model($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function redirect($url) {
        header("Location: $url");
        exit;
    }

    public function requireLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['usuario_id'])) {
        $this->redirect('/peoplepro/public/index.php?action=login');
    }
}

}
