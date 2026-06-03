<?php

$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $baseDir);
define('BASE_PATH', __DIR__);

require_once __DIR__ . '/config/Autoload.php';

use Controllers\AuthController;
use Controllers\ProductoController;
use Controllers\PublicController;
use Controllers\BitacoraController;

$route = isset($_GET['route']) ? rtrim($_GET['route'], '/') : 'catalogo';

$parts = explode('/', $route);

$controller_route = $parts[0] . (isset($parts[1]) ? '/' . $parts[1] : '');

$authController = new AuthController();
$productoController = new ProductoController();
$publicController = new PublicController();
$bitacoraController = new BitacoraController();

switch($controller_route){
    case 'api/productos':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $productoController->getProductsAPI();
        }
        break;

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
        if (isset($parts[2])) {
            $_GET['id'] = $parts[2]; 
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
    
    case 'bitacora':
        $bitacoraController->listar();
        break;

    case 'catalogo/buscar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $termino = $_POST['termino'] ?? '';
            // Redirigimos a la URL limpia: /catalogo/termino
            header("Location: " . BASE_URL . "catalogo/" . urlencode($termino));
            exit;
        }
        break;

    case 'catalogo':
    default:
        if (isset($parts[1]) && !empty($parts[1])) {
                // IMPORTANTE: Aquí le pasamos el valor al Controlador vía $_GET
                $_GET['buscar'] = $parts[1]; 
            }
        $publicController->catalogo();
        break;
}