<?php
require '../init.php';

require ROOT . '/models/Transporte.php'; 
require ROOT . '/models/TransporteModel.php';

$transporteModel = new TransporteModel();

// Inicializar datos básicos
$data = [
    'title' => 'Gestión de transportes',
    'transportes' => $transporteModel->getAll(),
];

$styles = ['transportes']; // Cargará /assets/admin/css/transportes.css
$scripts = ['transportes']; // Cargará /assets/admin/js/transportes.js

// RUTAS
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'crear': // Mostrar formulario de creación
        render('admin/views/transportes/crear.php', $data, $styles, $scripts);
        break;
    case 'post': // Crear transporte
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos
                $errors = validarDatos($_POST);

                // Crear instancia de Transporte
                $nuevoTransporte = new Transporte(
                    null, // ID se genera automáticamente en la base de datos
                    $_POST['tipo'],
                    $_POST['costo'],
                    $_POST['empresa']
                );

                // Intentar guardar en la base de datos
                if (empty($errors) && $transporteModel->crear($nuevoTransporte)) {
                    header('Location: ' . URLROOT . '/admin/transportes.php');
                    exit;
                } else {
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    throw new Exception("Error al crear el transporte.");
                }
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                render('admin/views/transportes/crear.php', $data, $styles, $scripts);
            }
        }
        break;

    case 'edit': // Editar transporte
        $id_transporte = $_GET['id'] ?? null;
        $data['transporte'] = null;

        if ($id_transporte) {
            $transporte = $transporteModel->getByID($id_transporte);
            if ($transporte) {
                $data['transporte'] = $transporte;
            } else {
                $data['errors'][] = "El transporte con ID $id_transporte no existe.";
            }
        } else {
            $data['errors'][] = "No se proporcionó un ID válido.";
        }

        render('admin/views/transportes/editar.php', $data, $styles, $scripts);
        break;

    case 'update': //Actualizacion de datos
        $id_transporte = $_GET['id'] ?? null;
        $transporteActualizado = new Transporte(
            $id_transporte,
            $_POST['tipo'] ?? '',
            $_POST['costo'] ?? '',
            $_POST['empresa'] ?? ''
        );
        if ($id_transporte && $transporteModel->actualizar($transporteActualizado)) {
            header('Location: ' . URLROOT . '/admin/transportes.php');
            exit;
        } else {
            $data['errors'][] = "No se pudo actualizar el transporte.";
            render('admin/views/transportes/index.php', $data, $styles, $scripts);
        }
        break;

    case 'delete': // Eliminar transporte
        $id_transporte = $_GET['id'] ?? null;
        if ($id_transporte && $transporteModel->eliminar($id_transporte)) {
            header('Location: ' . URLROOT . '/admin/transportes.php');
            exit;
        } else {
            $data['errors'][] = "No se pudo eliminar el transporte.";
            render('admin/views/transportes/index.php', $data, $styles, $scripts);
        }
        break;
    default: // Mostrar lista de transportes
        render('admin/views/transportes/index.php', $data, $styles, $scripts);
}
function validarDatos($data) {
    $errors = [];

    if (empty($data['tipo'])) {
        $errors[] = "El tipo de transporte es obligatorio.";
    }

    if (empty($data['costo']) || !is_numeric($data['costo']) || $data['costo'] < 0) {
        $errors[] = "El costo debe ser un número válido mayor o igual a 0.";
    }

    if (empty($data['empresa'])) {
        $errors[] = "El nombre de la empresa es obligatorio.";
    }

    return $errors;
}
