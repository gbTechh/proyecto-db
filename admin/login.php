<?php
require '../init.php';

require ROOT . '/models/Login.php'; 
require ROOT . '/models/Empleado.php'; 
require ROOT . '/models/EmpleadoModel.php';



$empleadoModel = new EmpleadoModel();

$data = [];

$styles = ['login']; // Cargará /assets/admin/css/login.css
$scripts = ['login']; // Cargará /assets/admin/js/login.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'post':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
            if (empty($_POST['username']) || empty($_POST['password'])) {
                throw new Exception("Todos los campos son requeridos");
            }
            $empleadoData = $empleadoModel->login(htmlspecialchars($_POST['username']), $_POST['password']);
            if (!is_null($empleadoData)) { 
                $_SESSION['empleado'] = [
                    'id' => $empleadoData->getID(),
                    'nombre' => $empleadoData->getNombreCompleto(),
                    'username' => $empleadoData->getUsername(),
                    'rol' => $empleadoData->getPuesto(),
                    'sucursal' => $empleadoData->getSucursal(),
                    'id_sucursal' => $empleadoData->getIdSucursal(),
                    'last_activity' => time(),
                    'is_logged_in' => true
                ];
                header('Location: ' . URLROOT . '/admin/clientes.php');
                exit;
            } else {
                $data['errors']['login'] = "Credenciales incorrectas";
                $data['old'] = $_POST;
                throw new Exception("Error al iniciar sesion");
            }
          } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $data['old'] = $_POST;
            renderLogin('admin/views/login/index.php', $data, $styles, $scripts);
          }
        }
        break;

    case 'editar':
        renderLogin('admin/views/login/editar.php', $data, $styles, $scripts);
        break;
    default:
        renderLogin('admin/views/login/index.php', $data, $styles, $scripts);
}

