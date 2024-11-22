<?php
require '../init.php';

require ROOT . '/models/Reserva.php'; 
require ROOT . '/models/ReservaModel.php';

$reservaModel = new ReservaModel();
$idSucursal =  strval($_SESSION['empleado']['id_sucursal']);
$reservas = $reservaModel->getAllConfirmadas($idSucursal);
$reservasPendientes = $reservaModel->getAllPendientes();

$data = [
  'title' => 'Lista de todas las reservas disponibles',
  'reservasConfirmadas' => $reservas,
  'reservasPendientes' => $reservasPendientes,
  'searchData' => [],
  'searchTerm' => '',
];

$styles = ['reservas']; // Cargará /assets/admin/css/reservas.cs s
$scripts = ['reservas']; // Cargará /assets/admin/js/reservas.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'confirmar':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'confirmar') {
            try {

                $resultado = $reservaModel->confirmarReserva(
                    $_POST['id'],
                    $_SESSION['empleado']['id_sucursal'],
                    $_SESSION['empleado']['id']
                );

                if ($resultado['success']) {
                    $data['success'] = $resultado['message'];
                }
                
                header('Location: ' . URLROOT . '/admin/reservas.php');
                exit;
                
            } catch (Exception $e) {
                $data['errors'] = $e->getMessage();
                render('admin/views/reservas/index.php', $data, $styles, $scripts);
            }
        }
        break;
    case 'search':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'search') {
            try {
                $resultado = $reservaModel->buscarReserva($_POST['search']);
                if ($resultado['success']) {
                    $data['searchData'] = $resultado['data'];
                    $data['searchTerm'] = $_POST['search'];
                }
                render('admin/views/reservas/index.php', $data, $styles, $scripts);
                exit;
                
            } catch (Exception $e) {
                $data['errors'] = $e->getMessage();
                render('admin/views/reservas/index.php', $data, $styles, $scripts);
            }
        }
        break;
    case 'crear':
        render('admin/views/reservas/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/reservas/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/reservas/index.php', $data, $styles, $scripts);
}

