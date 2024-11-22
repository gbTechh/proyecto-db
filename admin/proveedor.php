<?php
require '../init.php';

require ROOT . '/models/Proveedor.php'; 
require ROOT . '/models/ProveedorModel.php';

$proveedorModel = new ProveedorModel();
$proveedores = $proveedorModel->getAll();

$data = [
  'title' => 'Lista de todos los proveedores',
  'proveedores' => $proveedores
];

$styles = ['proveedor']; // Cargará /assets/admin/css/paquete_turistico.css
$scripts = ['proveedor']; // Cargará /assets/admin/js/paquete_turistico.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/proveedor/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/proveedor/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/proveedor/index.php', $data, $styles, $scripts);
}
