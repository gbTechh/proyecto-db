<?php
require '../init.php';

require ROOT . '/models/Proveedor.php';
require ROOT . '/models/ProveedorModel.php';

$proveedorModel = new ProveedorModel();
$proveedores = $proveedorModel->getAll();

$data = [
    'title' => 'Lista de Proveedores',
    'proveedores' => $proveedores
];

$styles = ['proveedor']; // Cargará /assets/admin/css/proveedores.css
$scripts = ['proveedor']; // Cargará /assets/admin/js/proveedores.js

// RUTAS
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'crear': // Mostrar formulario de creación
        render('admin/views/proveedor/crear.php', $data, $styles, $scripts);
        break;

    case 'post': // Procesar el formulario de creación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $errors = validarDatos($_POST);
                $nuevoProveedor = new Proveedor(
                    null, // ID generado automáticamente
                    $_POST['nombre'] ?? '',
                    $_POST['direccion'] ?? '',
                    $_POST['telefono'] ?? '',
                    $_POST['email'] ?? ''
                );

                // Guardar proveedor
                if (empty($errors) && $proveedorModel->crear($nuevoProveedor)) {
                    header('Location: ' . URLROOT . '/admin/proveedor.php');
                    exit;
                } else {
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    throw new Exception("Error al crear el proveedor.");
                }
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                render('admin/views/proveedor/crear.php', $data, $styles, $scripts);
            }
        }
        break;

    case 'editar': // Mostrar formulario de edición
        $id_proveedor = $_GET['id'] ?? null;
        $data['proveedor'] = null;
        
        if ($id_proveedor) {
            $proveedor = $proveedorModel->getByID($id_proveedor);
            if ($proveedor) {
                $data['proveedor'] = $proveedor;
            } else {
                header('Location: ' . URLROOT . '/admin/proveedor.php');
                exit;
            }
        } else {
            header('Location: ' . URLROOT . '/admin/proveedor.php');
            exit;
        }
        render('admin/views/proveedor/editar.php', $data, $styles, $scripts);
        break;

    case 'update': // Procesar actualización de proveedor
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id_proveedor = $_GET['id'] ?? null;
                $proveedorActualizado = new Proveedor(
                    $id_proveedor,
                    $_POST['nombre'] ?? '',
                    $_POST['direccion'] ?? '',
                    $_POST['telefono'] ?? '',
                    $_POST['email'] ?? ''
                );

                if ($id_proveedor && $proveedorModel->actualizar($proveedorActualizado)) {
                    header('Location: ' . URLROOT . '/admin/proveedor.php');
                    exit; // Salir para evitar que se ejecute más código
                }
            } catch (Exception $e) {
                // En caso de error, mostrar el mensaje y recargar el formulario de edición
                $proveedor = $proveedorModel->getByID($id_proveedor);
                $data['proveedor'] = $proveedor;
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;

                render('admin/views/proveedor/editar.php', $data, $styles, $scripts);
                exit;
            }
        }
        break;

    default:
        render('admin/views/proveedor/index.php', $data, $styles, $scripts);
}

function validarDatos($data) {
    $errors = [];

    // Validar nombre
    if (empty($data['nombre']) || strlen($data['nombre']) > 255) {
        $errors['nombre'] = "El nombre es obligatorio y debe tener menos de 255 caracteres.";
    }

    // Validar dirección
    if (empty($data['direccion'])) {
        $errors['direccion'] = "La dirección es obligatoria.";
    }

    // Validar teléfono
    if (empty($data['telefono']) || !preg_match('/^\+?[0-9]*$/', $data['telefono'])) {
        $errors['telefono'] = "El teléfono debe ser válido y contener solo números.";
    }

    // Validar email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "El correo electrónico debe ser válido.";
    }

    return $errors;
}
?>