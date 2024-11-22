<?php
require '../init.php';

require ROOT . '/models/Viaje.php'; 
require ROOT . '/models/ViajeModel.php';

$viajeModel = new ViajeModel();
$viajes = $viajeModel->getAll();

$data = [
  'title' => 'Lista de todas las viajes disponibles',
  'viajes' => $viajes
];

$styles = ['viajes']; // Cargará /assets/admin/css/viajes.css
$scripts = ['viajes']; // Cargará /assets/admin/js/viajes.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/viajes/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/viajes/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/viajes/index.php', $data, $styles, $scripts);
}

