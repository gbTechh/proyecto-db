<?php
require '../init.php';


$data = [
  'title' => 'Bienvenido',
  'description' => 'Página de inicio'
];

$styles = ['home']; // Cargará /assets/public/css/home.css
$scripts = ['home']; // Cargará /assets/public/js/home.js


//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        renderFront('public/views/home/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        renderFront('public/views/home/editar.php', $data, $styles, $scripts);
        break;
    default:
        renderFront('public/views/home/index.php', $data, $styles, $scripts);
}

