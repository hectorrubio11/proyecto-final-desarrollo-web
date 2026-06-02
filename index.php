<?php

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $baseDir);

require_once __DIR__ . '/config/Autoload.php';

use Controllers\AuthController;
use Controllers\ProductoController;
use Controllers\PublicController;

//Limpiamos la ruta para que no importe si tiene "/" al final
$route = isset($_GET['route']) ? rtrim($_GET['route'], '/') : 'catalogo';

// Separamos la ruta. Si es "productos/edit/2" -> $parts será ["productos", "edit", "2"]
$parts = explode('/', $route);

// Creamos una ruta base para el switch (sin el ID): "productos/edit"
$controller_route = $parts[0] . (isset($parts[1]) ? '/' . $parts[1] : '');

$authController = new AuthController();
$productoController = new ProductoController();
$publicController = new PublicController();

switch($controller_route){
    case 'login':
        $authController->showLogin();
        break;

    case 'auth/login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $authController->login();
        }
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'productos':
        $productoController->index();
        break;

    case 'productos/create':
        $productoController->create();
        break;

    case 'productos/store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $productoController->store();
        }
        break;

    case 'productos/edit':
        // Si la URL era "productos/edit/2", $parts[2] tiene el "2"
        if (isset($parts[2])) {
            $_GET['id'] = $parts[2]; // Se lo asignamos a $_GET['id'] para que el controlador lo encuentre
        }
        $productoController->edit();
        break;

    case 'productos/update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $productoController->update();
        }
        break;

    case 'productos/delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $productoController->delete();
        }
        break;

    case 'catalogo':
    default:
        $publicController->catalogo();
        break;
}