<?php
require_once 'models/Horario.php';

class HorariosController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Horario($pdo);
    }

    public function index() {
        $horarios = $this->model->obtenerTodos();
        include 'views/horarios/index.php';
    }

    public function crear() {
        $usuarios = $this->model->obtenerUsuarios();
        include 'views/horarios/formulario.php';
    }

    public function guardar() {
        $this->model->crear($_POST);
        header('Location: index.php?c=horarios');
    }

    public function editar() {
        $id = $_GET['id'];
        $horario = $this->model->obtenerPorId($id);
        $usuarios = $this->model->obtenerUsuarios();
        include 'views/horarios/formulario.php';
    }

    public function actualizar() {
        $id = $_GET['id'];
        $this->model->actualizar($id, $_POST);
        header('Location: index.php?c=horarios');
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->model->eliminar($id);
        header('Location: index.php?c=horarios');
    }
}
