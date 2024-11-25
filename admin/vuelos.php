<?php
require '../init.php';

require ROOT . '/models/Vuelo.php'; 
require ROOT . '/models/VueloModel.php';

$vueloModel = new VueloModel();
$total_vuelos = $vueloModel->getTotal();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
$paginator = new Paginator($total_vuelos, $page, $per_page);

$offset = $paginator->getOffset();


$vuelos = $vueloModel->getAll($per_page, $offset);

$data = [
  'title' => 'Lista de todos los vuelos disponibles',
  'vuelos' => $vuelos,
  'paginator' => $paginator
];

$styles = ['vuelos']; // Cargará /assets/admin/css/vuelos.css
$scripts = ['vuelos']; // Cargará /assets/admin/js/vuelos.js

//RUTAS
$action = $_GET['action'] ?? 'index';

if($page) {
    return render('admin/views/vuelos/index.php', $data, $styles, $scripts);
}

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

