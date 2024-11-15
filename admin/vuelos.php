<?php
require '../init.php';

require ROOT . '/models/Vuelo.php'; 
require ROOT . '/models/VueloModel.php';

$vueloModel = new VueloModel();
$vuelos = $vueloModel->getAll();

$data = [
  'title' => 'Lista de todos los vuelos disponibles',
  'vuelos' => $vuelos
];

$styles = ['vuelos']; // Cargará /assets/admin/css/vuelos.css
$scripts = ['vuelos']; // Cargará /assets/admin/js/vuelos.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/vuelos/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/vuelos/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/vuelos/index.php', $data, $styles, $scripts);
}

