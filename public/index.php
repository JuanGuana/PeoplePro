<?php
session_start();

// Parámetros desde la URL
$action = $_GET['action'] ?? 'landing';
$method = $_GET['method'] ?? 'index';
$id = $_GET['id'] ?? null;
$estado = $_GET['estado'] ?? null; // nuevo parámetro para métodos que lo necesiten

// Nombre del controlador y ruta del archivo
$controllerName = ucfirst($action) . 'Controller';
$controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

// Verificamos si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Verificamos si la clase existe
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        // Verificamos si el método existe
        if (method_exists($controller, $method)) {

            // Ejecutamos el método con los parámetros necesarios
            $reflection = new ReflectionMethod($controller, $method);
            $paramCount = $reflection->getNumberOfParameters();

            if ($paramCount === 2 && $id !== null && $estado !== null) {
                $controller->$method($id, $estado);
            } elseif ($paramCount === 1 && $id !== null) {
                $controller->$method($id);
            } else {
                $controller->$method();
            }

        } else {
            echo "Error: El método '$method' no existe en el controlador '$controllerName'.";
        }
    } else {
        echo "Error: La clase '$controllerName' no fue encontrada.";
    }
} else {
    echo "Error: El archivo del controlador '$controllerFile' no existe.";
}
