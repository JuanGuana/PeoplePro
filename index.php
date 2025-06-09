<?php
require_once 'config/Database.php';

$c = $_GET['c'] ?? 'horarios'; // controlador por defecto
$a = $_GET['a'] ?? 'index';    // acción por defecto

$controlador = ucfirst($c) . 'Controller';
$archivoControlador = "controllers/{$controlador}.php";

// Verifica que el archivo exista
if (file_exists($archivoControlador)) {
    require_once $archivoControlador;

    if (class_exists($controlador)) {
        $pdo = Database::connect();
        $controller = new $controlador($pdo);

        if (method_exists($controller, $a)) {
            $controller->$a();
            exit;
        } else {
            echo "Método '$a' no encontrado en el controlador '$controlador'.";
        }
    } else {
        echo "Clase del controlador '$controlador' no encontrada.";
    }
} else {
    echo "Archivo del controlador '$archivoControlador' no encontrado.";
}
