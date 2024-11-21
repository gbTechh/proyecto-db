<?php
require '../init.php';

require ROOT . '/models/Reserva.php'; 
require ROOT . '/models/ReservaModel.php';

$reservaModel = new ReservaModel();
$reservas = $reservaModel->getAll();

$data = [
  'title' => 'Lista de todas las reservas disponibles',
  'reservas' => $reservas
];

$styles = ['reservas']; // Cargará /assets/admin/css/reservas.css
$scripts = ['reservas']; // Cargará /assets/admin/js/reservas.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/reservas/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/reservas/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/reservas/index.php', $data, $styles, $scripts);
}

