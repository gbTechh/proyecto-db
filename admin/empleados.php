<?php
require '../init.php';

require ROOT . '/models/Empleado.php'; 
require ROOT . '/models/EmpleadoModel.php';
require ROOT . '/models/Sucursal.php';
require ROOT . '/models/SucursalModel.php';

if(!($_SESSION['empleado']['rol'] == "Administrador" || $_SESSION['empleado']['rol'] == "Gerente") ) {
    header('Location: ' . URLROOT . '/admin/index.php');
}

$sucursal = $_SESSION['empleado']['rol'] == "Administrador" ? null : $_SESSION['empleado']['id_sucursal'];



$empleadoModel = new EmpleadoModel();
$empleados = $empleadoModel->getAll($sucursal);

$data = [
  'title' => 'Lista de Empleados',
  'empleados' => $empleados
];
$styles = ['empleados']; // Cargará /assets/admin/css/empleados.css
$scripts = ['empleados']; // Cargará /assets/admin/js/empleados.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
            $_POST['sucursal'] = $_POST['sucursal'] ?? $_SESSION['empleado']['id_sucursal'];
            $errors = validarDatos($_POST);
            $nuevoEmpleado = new Empleado(
              $_POST['dni'],
              $_POST['nombre'],
              $_POST['apellidos'],
              $_POST['telefono'],
              intval($_POST['sucursal']),
              $_POST['puesto'],
              $_POST['e_username'],
              $_POST['e_password'],
            );
          
            if (empty($errors) && $empleadoModel->crear($nuevoEmpleado)) { 
                header('Location: ' . URLROOT . '/admin/empleados.php');
                exit;
            } else {
                $data['errors'] = $errors;
                $data['old'] = $_POST;
                throw new Exception("Error al crear el empleado");
            }
          } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $data['old'] = $_POST;
            $sucursalModel = new SucursalModel();
            $sucursales = $sucursalModel->getAll();
            $data['sucursales'] = $sucursales;
            render('admin/views/empleados/crear.php', $data, $styles, $scripts);
          }
        }
        break;
    case 'crear':
        $sucursalModel = new SucursalModel();
        $sucursales = $sucursalModel->getAll();
        $data['sucursales'] = $sucursales;
        render('admin/views/empleados/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/empleados/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/empleados/index.php', $data, $styles, $scripts);
}


function validarDatos($data) {
  $empleadoModel = new EmpleadoModel();
  $errors = [];

  // Validar DNI
  if (empty($data['dni'])) {
      $errors['dni'] = 'El dni es requerido';
  } elseif (strlen($data['dni']) != 8) {
      $errors['dni'] = 'El dni solo puede tener 8 caracteres';
  } elseif (!is_numeric($data['dni'])) {
      $errors['dni'] = 'El dni solo puede ser numeros';
  }

  // Validar nombre
  if (empty($data['nombre'])) {
      $errors['nombre'] = 'El nombre es requerido';
  } elseif (strlen($data['nombre']) > 50) {
      $errors['nombre'] = 'El nombre no puede exceder 50 caracteres';
  }

  // Validar apellidos
  if (empty($data['apellidos'])) {
      $errors['apellidos'] = 'El apellido es requerido';
  }

  // Validar username
  if (empty($data['e_username'])) {
      $errors['e_username'] = 'El nombre de usuario es requerido';
  } elseif ($empleadoModel->existeUsername($data['e_username'])) {
      $errors['e_username'] = 'Este nombre de usuario ya está registrado';
  }
  // Validar password
  if (empty($data['e_password'])) {
      $errors['e_password'] = 'El nombre de usuario es requerido';
  }

  // Validar teléfono (opcional)
  var_dump($data['telefono']);
  if (!empty($data['telefono']) && !is_numeric($data['telefono'])) {
      $errors['telefono'] = 'El teléfono debe contener solo números';
  }

  return $errors;
}