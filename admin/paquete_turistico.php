<?php
require '../init.php';

require ROOT . '/models/PaqueteTuristico.php'; 
require ROOT . '/models/PaqueteTuristicoModel.php';

$paqueteTuristicoModel = new PaqueteTuristicoModel();
$paquetes = $paqueteTuristicoModel->getAll();

$data = [
  'title' => 'Lista de todos los paquetes turisticos disponibles',
  'paquetes' => $paquetes
];

$styles = ['paquete_turistico']; // Cargará /assets/admin/css/paquete_turistico.css
$scripts = ['paquete_turistico']; // Cargará /assets/admin/js/paquete_turistico.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/paquete_turistico/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/paquete_turistico/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/paquete_turistico/index.php', $data, $styles, $scripts);
}
