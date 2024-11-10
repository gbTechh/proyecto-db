<?php
// Definir la raíz del proyecto
define('ROOT', dirname(__DIR__));
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once dirname(__DIR__) . '/app/config/config.php';
// Cargar el autoloader
require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Router.php';
require_once ROOT . '/core/Layout.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/Database.php';


try {
    $router = new Router();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}