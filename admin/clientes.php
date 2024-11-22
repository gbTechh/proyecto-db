<?php
require '../init.php';

require ROOT . '/models/Cliente.php'; 
require ROOT . '/models/ClienteModel.php';

// Verificar si hay sesión activa
if (!isset($_SESSION['empleado']) || $_SESSION['empleado']['is_logged_in'] !== true) {
    header('Location: ' . URLROOT . '/admin/login.php');
    exit;
}

$clienteModel = new ClienteModel();
$clientes = $clienteModel->getAll();

$data = [
  'title' => 'Lista de Clientes',
  'clientes' => $clientes
];

$styles = ['clientes']; // Cargará /assets/admin/css/cliente.css
$scripts = ['clientes']; // Cargará /assets/admin/js/cliente.js


//RUTAS
$action = $_GET['action'] ?? 'index';
switch($action) {
    case 'crear':
        render('admin/views/clientes/crear.php', $data, $styles, $scripts);
        break;
    case 'post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
            $errors = validarDatos($_POST);
            $nuevoCliente = new Cliente(
              $_POST['dni'],
              $_POST['nombre'],
              $_POST['apellidos'],
              $_POST['telefono'],
              $_POST['email'],
              $_POST['username'],
              $_POST['password'],
            );
          
            if (empty($errors) && $clienteModel->crear($nuevoCliente)) { 
                header('Location: ' . URLROOT . '/admin/clientes.php');
                exit;
            } else {
                $data['errors'] = $errors;
                $data['old'] = $_POST;
                throw new Exception("Error al crear el cliente");
            }
          } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $data['old'] = $_POST;
            render('admin/views/clientes/crear.php', $data, $styles, $scripts);
          }
        }
        break;
    case 'editar':
        render('admin/views/clientes/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/clientes/index.php', $data, $styles, $scripts);
}



function validarDatos($data) {
  $clienteModel = new ClienteModel();
  $errors = [];

  // Validar DNI
  if (empty($data['dni'])) {
      $errors['dni'] = 'El dni es requerido';
  } elseif (strlen($data['dni']) > 9) {
      $errors['dni'] = 'El dni no puede exceder 8 caracteres';
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

  // Validar email
  if (empty($data['email'])) {
      $errors['email'] = 'El email es requerido';
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'El email no es válido';
  } elseif ($clienteModel->existeEmail($data['email'])) {
      $errors['email'] = 'Este email ya está registrado';
  }

  // Validar teléfono (opcional)
  if (!empty($data['telefono']) && !preg_match('/^[0-9]{9}$/', $data['telefono'])) {
      $errors['telefono'] = 'El teléfono debe tener 9 dígitos';
  }

  return $errors;
}