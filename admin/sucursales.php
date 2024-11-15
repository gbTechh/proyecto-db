<?php
require '../init.php';

require ROOT . '/models/Sucursal.php'; 
require ROOT . '/models/SucursalModel.php';

$sucursalModel = new SucursalModel();
$sucursales = $sucursalModel->getAll();

$data = [
  'title' => 'Lista de sucursales',
  'sucursales' => $sucursales
];

$styles = ['sucursal']; // Cargará /assets/admin/css/sucursal.css
$scripts = ['sucursal']; // Cargará /assets/admin/js/sucursal.js


//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear':
        render('admin/views/sucursales/crear.php', $data, $styles, $scripts);
        break;
    case 'post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
            $errors = validarDatos($_POST);
            $nuevaSucursal = new Sucursal(
                $_POST['ID_sucursal'] ?? '',
                $_POST['direccion'],
                $_POST['telefono'],
                $_POST['nombre'],
            );

          
            if (empty($errors) && $sucursalModel->crear($nuevaSucursal)) { 
                header('Location: ' . URLROOT . '/admin/sucursales.php');
                exit;
            } else {
                $data['errors'] = $errors;
                $data['old'] = $_POST;
                throw new Exception("Error al crear la sucursal");
            }
          } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $data['old'] = $_POST;
            render('admin/views/sucursales/crear.php', $data, $styles, $scripts);
          }
        }
        break;
    case 'editar':
        render('admin/views/sucursales/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/sucursales/index.php', $data, $styles, $scripts);
}


function validarDatos($data) {
    $sucursalModel = new SucursalModel();
    $errors = [];

    // Validar nombre de sucursal
    if (empty($data['nombre'])) {
      $errors['nombre'] = 'El nombre es requerido';
    } elseif (strlen($data['nombre']) > 50) {
      $errors['nombre'] = 'El nombre no puede exceder 50 caracteres';
    } elseif ($sucursalModel->existeNombre($data['nombre'], isset($data['ID_sucursal']) ? $data['ID_sucursal'] : null)) {
      $errors['nombre'] = 'Ya existe una sucursal con ese nombre';
    }

    // Validar direccion
    if (empty($data['direccion'])) {
      $errors['direccion'] = 'La direccion es requerida';
    } elseif (strlen($data['direccion']) > 50) {
      $errors['direccion'] = 'La direccion no puede exceder 50 caracteres';
    }
    // Validar teléfono (obligatorio)
    if (empty($data['telefono'])) {
      $errors['telefono'] = 'El teléfono es requerido';
    } elseif (!preg_match('/^[0-9]{9}$/', $data['telefono'])) {
      $errors['telefono'] = 'El teléfono debe tener 9 dígitos';
    }

    return $errors;
}

