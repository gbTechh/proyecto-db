<?php
require '../init.php';

require ROOT . '/models/Hotel.php'; 
require ROOT . '/models/HotelModel.php';
require ROOT . '/models/Ciudad.php'; 
require ROOT . '/models/CiudadModel.php';
require ROOT . '/models/Proveedor.php'; 
require ROOT . '/models/ProveedorModel.php';

$hotelModel = new HotelModel();
$hoteles = $hotelModel->getAll();

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

$proveedorModel = new ProveedorModel();
$proveedores = $proveedorModel->getAll();

$data = [
  'title' => 'Lista de Hoteles',
  'hoteles' => $hoteles,
  'ciudades' => $ciudades,
  'proveedores' => $proveedores
];

$styles = ['hoteles']; // Cargará /assets/admin/css/hoteles.css
$scripts = ['hoteles']; // Cargará /assets/admin/js/hoteles.js


//RUTAS
$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'crear': 
        render('admin/views/hoteles/crear.php', $data, $styles, $scripts);
        break;

    case 'post': 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Primero validamos todos los datos
                $errors = validarDatos($_POST);
                
                // Validar que se haya seleccionado al menos un proveedor
                $id_proveedores = $_POST['id_proveedor'] ?? [];
                if (empty($id_proveedores)) {
                    $errors['id_proveedor'] = "Debe seleccionar al menos un proveedor.";
                }

                // Si hay errores, lanzar excepción antes de subir la imagen
                if (!empty($errors)) {
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    throw new Exception("Error de validación en los datos proporcionados.");
                }

                // Si no hay errores, procedemos a subir la imagen
                $resultado_subida = subirImagen($_FILES["imagen"]);
                
                if (!$resultado_subida['success']) {
                    throw new Exception($resultado_subida['mensaje']);
                }

                $nuevoHotel = new Hotel(
                    null, 
                    $_POST['nombre'],
                    $_POST['direccion'],
                    $_POST['categoria'],
                    $_POST['telefono'],
                    $_POST['precio_por_noche'],
                    $_POST['id_ciudad'],
                    $resultado_subida['nombre_archivo']
                );

                // Crear el hotel en la base de datos
                $id_hotel = $hotelModel->crear($nuevoHotel);

                if ($id_hotel) {
                    // Asociar cada proveedor al hotel
                    foreach ($id_proveedores as $id_proveedor) {
                        $hotelModel->asociarProveedor($id_hotel, $id_proveedor);
                    }
                    header('Location: ' . URLROOT . '/admin/hoteles.php');
                    exit;
                } else {
                    throw new Exception("Error al crear el hotel en la base de datos.");
                }
                
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                render('admin/views/hoteles/crear.php', $data, $styles, $scripts);
            }
        }
        break;
        
    case 'editar':
        $id_hotel = $_GET['id'] ?? null;
        if ($id_hotel) {
            $hotel = $hotelModel->getByID($id_hotel);
            if ($hotel) {
                $proveedoresAsociados = $proveedorModel->getProveedoresByHotel($hotel->getID());
                $data['hotel'] = $hotel;
                $data['proveedoresAsociados'] = $proveedoresAsociados;
                render('admin/views/hoteles/editar.php', $data, $styles, $scripts);
            } else {
                header('Location: ' . URLROOT . '/admin/hoteles.php');
                exit;
            }
        } else {
            header('Location: ' . URLROOT . '/admin/hoteles.php');
            exit;
        }
        break;
    case 'update': // Procesar formulario de edición
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Primero validamos todos los datos
                $errors = validarDatos($_POST);
                
                $id_hotel = $_GET['id'] ?? null;
                if (!$id_hotel) {
                    throw new Exception("ID del hotel no proporcionado.");
                }

                $ids_proveedores = $_POST['id_proveedor'] ?? [];
                if (empty($ids_proveedores)) {
                    $errors['id_proveedor'] = "Debe seleccionar al menos un proveedor.";
                }

                // Si hay errores, lanzar excepción antes de subir la imagen
                if (!empty($errors)) {
                    $hotel = $hotelModel->getByID($id_hotel);
                    $proveedoresAsociados = $proveedorModel->getProveedoresByHotel($hotel->getID());
                    
                    $data['hotel'] = $hotel;
                    $data['proveedoresAsociados'] = $proveedoresAsociados;
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                    
                    render('admin/views/hoteles/editar.php', $data, $styles, $scripts);
                    exit;
                }

                // Si no hay errores, procedemos a subir la imagen
                $resultado_subida = subirImagen($_FILES["imagen"]);
                    
                if (!$resultado_subida['success']) {
                    throw new Exception($resultado_subida['mensaje']);
                }
                
                $hotelActualizado = new Hotel(
                    $id_hotel,
                    $_POST['nombre'],
                    $_POST['direccion'],
                    $_POST['categoria'],
                    $_POST['telefono'],
                    $_POST['precio_por_noche'],
                    $_POST['id_ciudad'],
                    $resultado_subida['nombre_archivo']
                );

                if ($hotelModel->actualizar($hotelActualizado, $ids_proveedores)) {
                    header('Location: ' . URLROOT . '/admin/hoteles.php');
                    exit;
                } else {
                    throw new Exception("Error al actualizar el hotel");
                }
                
            } catch (Exception $e) {
                $hotel = $hotelModel->getByID($id_hotel);
                $proveedoresAsociados = $proveedorModel->getProveedoresByHotel($hotel->getID());
                
                $data['hotel'] = $hotel;
                $data['proveedoresAsociados'] = $proveedoresAsociados;
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
                
                render('admin/views/hoteles/editar.php', $data, $styles, $scripts);
                exit;
            }
        }
        break;
    case 'verProveedores':
        $id_hotel = $_GET['id'] ?? null;
    
        if ($id_hotel) {
            $hotel = $hotelModel->getByID($id_hotel);
            $ciudad =  $ciudadModel ->getByID($hotel->getCiudad());
            $proveedoresAsociados = $proveedorModel->getProveedoresByHotel($hotel->getID());
            if ($hotel) {
                $data['hotel'] = $hotel;
                $data['ciudad'] = $ciudad;
                $data['proveedoresAsociados'] = $proveedoresAsociados;
                $data['old'] = $_POST;

                render('admin/views/hoteles/ver_proveedores.php', $data, $styles, $scripts);
            } else {
                $data['errors'][] = "No se encontró el hotel.";
                render('admin/views/hoteles/index.php', $data, $styles, $scripts);
            }
        } else {
            $data['errors'][] = "ID del hotel no proporcionado.";
            render('admin/views/hoteles/index.php', $data, $styles, $scripts);
        }
        break;
    
    case 'delete':
        $id_hotel = $_GET['id'] ?? null;
        if ($id_hotel && $hotelModel->eliminar($id_hotel)) {
            header('Location: ' . URLROOT . '/admin/hoteles.php');
            exit;
        } else {
            $data['errors'][] = "No se pudo eliminar el hotel.";
            render('admin/views/hoteles/index.php', $data, $styles, $scripts);
        }
        break;
    default:
        render('admin/views/hoteles/index.php', $data, $styles, $scripts);
}


function validarDatos($data) {
    $errors = [];

    // Nombre (requerido, longitud máxima 100)
    if (empty($data['nombre'])) {
        $errors['nombre'] = 'El nombre del hotel es obligatorio.';
    } elseif (strlen($data['nombre']) > 100) {
        $errors['nombre'] = 'El nombre no puede tener más de 100 caracteres.';
    }

    // Validar dirección
    if (empty($data['direccion'])) {
        $errors['direccion'] = 'La dirección es requerida';
    }

     // Categoría (requerida, valor válido)
     $categoriasValidas = ['1 estrella', '2 estrellas', '3 estrellas', '4 estrellas', '5 estrellas'];
     if (empty($data['categoria'])) {
         $errors['categoria'] = 'Debe seleccionar una categoría.';
     } elseif (!in_array($data['categoria'], $categoriasValidas)) {
         $errors['categoria'] = 'Debe seleccionar una categoría válida.';
     }

    // Validar teléfono
    if (empty($data['telefono'])) {
        $errors['telefono'] = 'El teléfono es requerido';
    } elseif (!preg_match('/^[0-9]{9}$/', $data['telefono'])) {
        $errors['telefono'] = 'El teléfono debe tener 9 dígitos y no tener letras';
    }

    // Precio por noche (requerido, positivo)
    if (empty($data['precio_por_noche']) || !is_numeric($data['precio_por_noche']) || $data['precio_por_noche'] <= 0) {
        $errors['precio_por_noche'] = 'El precio por noche debe ser un número positivo.';
    }

    // Validar ID de ciudad
    if (empty($data['id_ciudad']) || !is_numeric($data['id_ciudad'])) {
        $errors['id_ciudad'] = 'Debe seleccionar una ciudad válida';
    }
    return $errors;
}

