<?php
require '../init.php';

require ROOT . '/models/Servicio.php'; 
require ROOT . '/models/ServicioModel.php';
require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';

$servicioModel = new ServicioModel();
$servicios = $servicioModel->getAll();

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$data = [
  'title' => 'Lista de todos los servicios disponibles',
  'servicios' => $servicios,
  'ciudades' => $ciudades
];

$styles = ['servicio']; // Cargará /assets/admin/css/servicio.css
$scripts = ['servicio']; // Cargará /assets/admin/js/servicio.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/servicios/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/servicios/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/servicios/index.php', $data, $styles, $scripts);
}
