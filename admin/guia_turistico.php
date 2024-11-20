<?php
require '../init.php';

require ROOT . '/models/GuiaTuristico.php'; 
require ROOT . '/models/GuiaTuristicoModel.php';
require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';

$guiaModel = new GuiaTuristicoModel();
$guias = $guiaModel->getAll();

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$data = [
  'title' => 'Lista de Guías Turísticos',
  'guias' => $guias,
  'ciudades' => $ciudades,
];

$styles = ['guias']; // Cargará /assets/admin/css/guias.css
$scripts = ['guias']; // Cargará /assets/admin/js/guias.js


//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear': // Mostrar formulario de creación
        render('admin/views/guias/crear.php', $data, $styles, $scripts);
        break;

    case 'post': //Procesar el formulario de creación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          try {
            $errors = validarDatos($_POST);
            $nuevoGuia = new GuiaTuristico(
                null, // El id es generado automáticamente
                $_POST['nombre'],
                $_POST['telefono'],
                $_POST['idiomas'],
                $_POST['id_ciudad']
            );

            if (empty($errors) && $guiaModel->crear($nuevoGuia)) { 
                header('Location: ' . URLROOT . '/admin/guia_turistico.php');
                exit;
            } else {
                $data['errors'] = $errors;
                $data['old'] = $_POST;
                throw new Exception("Error al crear el Guía Turístico");
            }
          } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $data['old'] = $_POST;
            render('admin/views/guias/crear.php', $data, $styles, $scripts);
          }
        }
        break;
    case 'editar':
        $id_guia = $_GET['id'] ?? null;
        if ($id_guia) {
            $guia = $guiaModel->getByID($id_guia);
            if ($guia) {
                $data['guia'] = $guia;
                render('admin/views/guias/editar.php', $data, $styles, $scripts);
            } else {
                header('Location: ' . URLROOT . '/admin/guia_turistico.php');
                exit;
            }
        } else {
            header('Location: ' . URLROOT . '/admin/guia_turistico.php');
            exit;
        }
        break;
    
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $errors = validarDatos($_POST);
    
                $id_guia = $_GET['id'] ?? null;
                if (!$id_guia) {
                    throw new Exception("ID del guía no proporcionado.");
                }
                
                $guiaActualizado = new GuiaTuristico(
                    $id_guia,
                    $_POST['nombre'],
                    $_POST['telefono'],
                    $_POST['idiomas'],
                    $_POST['id_ciudad']
                );
    
                if (empty($errors)) {
                    if ($guiaModel->actualizar($guiaActualizado)) {
                        header('Location: ' . URLROOT . '/admin/guia_turistico.php');
                        exit;
                    } else {
                        throw new Exception("Error al actualizar el guía");
                    }
                } else {
                    $guia = $guiaModel->getByID($id_guia);
                    
                    $data['guia'] = $guia;
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    
                    render('admin/views/guias/editar.php', $data, $styles, $scripts);
                    exit;
                }
            } catch (Exception $e) {
                $guia = $guiaModel->getByID($id_guia);
                
                $data['guia'] = $guia;
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                
                render('admin/views/guias/editar.php', $data, $styles, $scripts);
                exit;
            }
        }
        break;
    default:
        render('admin/views/guias/index.php', $data, $styles, $scripts);
}


function validarDatos($data) {
    $errors = [];

    // Nombre (requerido, longitud máxima 100)
    if (empty($data['nombre'])) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    } elseif (strlen($data['nombre']) > 100) {
        $errors['nombre'] = 'El nombre no puede tener más de 100 caracteres.';
    }

    // Validar teléfono
    if (empty($data['telefono'])) {
        $errors['telefono'] = 'El teléfono es requerido';
    } elseif (!preg_match('/^[0-9]{9}$/', $data['telefono'])) {
        $errors['telefono'] = 'El teléfono debe tener 9 dígitos y no tener letras';
    }

    // Validar ID de ciudad
    if (empty($data['idiomas'])) {
        $errors['idiomas'] = 'El idioma es obligatorio';
    }
    return $errors;

    // Validar ID de ciudad
    if (empty($data['id_ciudad']) || !is_numeric($data['id_ciudad'])) {
        $errors['id_ciudad'] = 'Debe seleccionar una ciudad válida';
    }
    return $errors;
}

