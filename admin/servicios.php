<?php
require '../init.php';

require ROOT . '/models/Servicio.php';
require ROOT . '/models/ServicioModel.php';
require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';
require ROOT . '/models/Proveedor.php'; 
require ROOT . '/models/ProveedorModel.php';

$servicioModel = new ServicioModel();
$servicios = $servicioModel->getAll();

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$proveedorModel = new ProveedorModel();
$proveedores = $proveedorModel->getAll();

$data = [
    'title' => 'Lista de Servicios',
    'servicios' => $servicios,
    'ciudades' => $ciudades,
    'proveedores' => $proveedores
];

$styles = ['servicios']; // Cargará /assets/admin/css/servicios.css
$scripts = ['servicios']; // Cargará /assets/admin/js/servicios.js

// RUTAS
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'crear': // Mostrar formulario de creación
        render('admin/views/servicios/crear.php', $data, $styles, $scripts);
        break;

    case 'post': // Procesar el formulario de creación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $errors = validarDatos($_POST);
                $nuevoServicio = new Servicio(
                    null, // ID se genera automáticamente
                    $_POST['descripcion'] ,
                    $_POST['id_proveedor'] ,
                    $_POST['costo'] ,
                    $_POST['id_ciudad'] 
                );

                // Guardar servicio
                if (empty($errors) && $servicioModel->crear($nuevoServicio)) {
                    header('Location: ' . URLROOT . '/admin/servicios.php');
                    exit;
                } else {
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    throw new Exception("Error al crear el servicio.");
                }
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                render('admin/views/servicios/crear.php', $data, $styles, $scripts);
            }
        }
        break;

    case 'editar': // Mostrar formulario de edición
        $id_servicio = $_GET['id'] ?? null;
        $data['servicio'] = null;
        
        if ($id_servicio) {
            $servicio = $servicioModel->getByID($id_servicio);
            if ($servicio) {
                $data['servicio'] = $servicio;
            } else {
                header('Location: ' . URLROOT . '/admin/servicios.php');
                exit;
            }
        } else {
            header('Location: ' . URLROOT . '/admin/servicios.php');
            exit;
        }
        render('admin/views/servicios/editar.php', $data, $styles, $scripts);
        break;

    case 'update': // Procesar actualización de servicio
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id_servicio = $_GET['id'] ?? null;
                $servicioActualizado = new Servicio(
                    $id_servicio,
                    $_POST['descripcion'] ?? '',
                    $_POST['id_proveedor'] ?? '',
                    $_POST['costo'] ?? '',
                    $_POST['id_ciudad'] ?? ''
                );

                if ($id_servicio && $servicioModel->actualizar($servicioActualizado)) {
                    header('Location: ' . URLROOT . '/admin/servicios.php');
                    exit; // Salir para evitar que se ejecute más código
                }
            } catch (Exception $e) {
                // En caso de error, mostrar el mensaje y recargar el formulario de edición
                $servicio = $servicioModel->getByID($id_servicio);
                $data['servicio'] = $servicio;
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;

                render('admin/views/servicios/editar.php', $data, $styles, $scripts);
                exit;
            }
        }
        break;
    default:
        render('admin/views/servicios/index.php', $data, $styles, $scripts);
}

function validarDatos($data) {
    $errors = [];

    // Validar costo
    if (empty($data['costo']) || !is_numeric($data['costo']) || $data['costo'] < 0) {
        $errors['costo'] = "El costo debe ser un número válido mayor o igual a 0.";
    }


    return $errors;
}
?>
