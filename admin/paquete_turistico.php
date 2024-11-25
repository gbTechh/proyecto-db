<?php
require '../init.php';

require ROOT . '/models/PaqueteTuristico.php'; 
require ROOT . '/models/PaqueteTuristicoModel.php';
require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';

$paqueteTuristicoModel = new PaqueteTuristicoModel();
$paquetes = $paqueteTuristicoModel->getAll();

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$data = [
  'title' => 'Lista de todos los paquetes turisticos disponibles',
  'paquetes' => $paquetes,
  'ciudades' => $ciudades
];

$styles = ['paquete_turistico']; // Cargará /assets/admin/css/paquete_turistico.css
$scripts = ['paquete_turistico']; // Cargará /assets/admin/js/paquete_turistico.js

//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'post': // Crear paquete turistico
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos
                $errors = validarDatos($_POST);

                // Crear instancia de paquete_turistico
                $nuevoPaqueteTuristico = new PaqueteTuristico(
                    null, // ID se genera automáticamente en la base de datos
                    $_POST['nombre'],
                    $_POST['descripcion'],
                    $_POST['precio'],
                    $_POST['id_ciudad']                    
                );

                // Intentar guardar en la base de datos
                if (empty($errors) && $paqueteTuristicoModel->crear($nuevoPaqueteTuristico)) {
                    header('Location: ' . URLROOT . '/admin/paquete_turistico.php');
                    exit;
                } else {
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    throw new Exception("Error al crear el paquete turistico.");
                }
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                render('admin/views/paquete_turistico/crear.php', $data, $styles, $scripts);
            }
        }
        break;
    case 'crear':
        render('admin/views/paquete_turistico/crear.php', $data, $styles, $scripts);
        break;
    case 'editar':
        render('admin/views/paquete_turistico/editar.php', $data, $styles, $scripts);
        break;
    default:
        render('admin/views/paquete_turistico/index.php', $data, $styles, $scripts);
}
function validarDatos($data) {
    $errors = [];

    // Validar costo
    if (empty($data['precio']) || !is_numeric($data['precio']) || $data['precio'] < 0) {
        $errors['precio'] = "El costo debe ser un número válido mayor o igual a 0.";
    }


    return $errors;
}
?>