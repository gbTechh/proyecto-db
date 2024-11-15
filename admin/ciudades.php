<?php
require '../init.php';

require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$data = [
   'title' => 'Lista de todas las ciudades disponibles',
   'ciudades' => $ciudades
];

$styles = ['ciudades']; // Cargará /assets/admin/css/ciudades.css
$scripts = ['ciudades']; // Cargará /assets/admin/js/ciudades.js


//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/ciudades/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/ciudades/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/ciudades/index.php', $data, $styles, $scripts);
}

