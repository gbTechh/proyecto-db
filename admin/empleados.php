<?php
require '../init.php';

require ROOT . '/models/Empleado.php'; 
require ROOT . '/models/EmpleadoModel.php';

$empleadoModel = new EmpleadoModel();
$empleados = $empleadoModel->getAll();

$data = [
  'title' => 'Lista de Empleados',
  'empleados' => $empleados
];
$styles = ['empleados']; // Cargará /assets/admin/css/empleados.css
$scripts = ['empleados']; // Cargará /assets/admin/js/empleados.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/empleados/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/empleados/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/empleados/index.php', $data, $styles, $scripts);
}
