<?php
require '../init.php';

require ROOT . '/models/Transporte.php'; 
require ROOT . '/models/TransporteModel.php';

$transporteModel = new TransporteModel();
$transportes = $transporteModel->getAll();

$data = [
  'title' => 'Lista de todos los transportes disponibles',
  'transportes' => $transportes
];

$styles = ['transportes']; // Cargará /assets/admin/css/transportes.css
$scripts = ['transportes']; // Cargará /assets/admin/js/transportes.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/transportes/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/transportes/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/transportes/index.php', $data, $styles, $scripts);
}
