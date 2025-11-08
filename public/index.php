<?php
// Simple front controller
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Controller.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'tipos';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerFile = __DIR__ . '/../app/controllers/' . ucfirst($controller) . 'Controller.php';
$controllerClass = ucfirst($controller) . 'Controller';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerClass)) {
        $c = new $controllerClass();
        if (method_exists($c, $action)) {
            $c->{$action}();
        } else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo "Action not found";
        }
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
        echo "Controller class not found";
    }
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "Controller file not found";
}
