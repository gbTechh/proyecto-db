<?php
require '../init.php';
require ROOT . '/models/Ciudad.php';
require ROOT . '/models/CiudadModel.php';
require ROOT . '/models/Vuelo.php';
require ROOT . '/models/VueloModel.php';
require ROOT . '/models/PaqueteTuristico.php';
require ROOT . '/models/PaqueteTuristicoModel.php';
require ROOT . '/models/Hotel.php';
require ROOT . '/models/HotelModel.php';
require ROOT . '/models/Transporte.php';
require ROOT . '/models/TransporteModel.php';
require ROOT . '/models/Servicio.php';
require ROOT . '/models/ServicioModel.php';
require ROOT . '/models/GuiaTuristico.php';
require ROOT . '/models/GuiaTuristicoModel.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Error al decodificar los datos JSON'); 
    }

    $origen = $data['origin'] ?? '';
    $destino = $data['destination'] ?? '';
    $fechaInicio = $data['start_date'] ?? '';
    $fechaFin = $data['end_date'] ?? '';
    //var_dump($origen,$destino);
    $vueloModel = new VueloModel();
    $vuelos = $vueloModel->buscarVuelos($origen, $destino, $fechaInicio, $fechaFin);
    //var_dump($vuelos);
    // Buscar paquetes turísticos
    $paqueteModel = new PaqueteTuristicoModel();
    $paquetes = $paqueteModel->buscarPaquetes($destino);

    $hotelModel = new HotelModel();
    $hoteles = $hotelModel->buscarHoteles($destino);
    //var_dump($hoteles);

    $transporteModel = new TransporteModel();
    $transportes = $transporteModel->get4();
    //var_dump($transportes);
    $servicioModel = new ServicioModel();
    $servicios = $servicioModel->buscarServicios($destino);
    //var_dump($servicios);
    $guiaturisticoModel = new GuiaTuristicoModel();
    $guiasturisticos = $guiaturisticoModel->buscarGuias($destino);
    //var_dump($guiasturisticos);
    // Preparar la respuesta combinada
    $response = [
        'vuelos' => [
            'ida' => [],
            'regreso' => []
        ],
        'paquetes' => [],
        'hoteles' => [],
        'transportes' => [],
        'servicios' => [],
        'guiasturisticos' => []
    ];

    // Procesar los vuelos de ida
    foreach ($vuelos['ida'] as $vuelo) {
        $response['vuelos']['ida'][] = [
            'id' => $vuelo['id'],
            'num_vuelo' => $vuelo['num_vuelo'],
            'origen' => $vuelo['origen'],
            'destino' => $vuelo['destino'],
            'fecha_salida' => $vuelo['fecha_salida'],
            'fecha_llegada' => $vuelo['fecha_llegada'],
            'precio' => $vuelo['precio']
        ];
    }

    // Procesar los vuelos de regreso
    foreach ($vuelos['regreso'] as $vuelo) {
        $response['vuelos']['regreso'][] = [
            'id' => $vuelo['id'],
            'num_vuelo' => $vuelo['num_vuelo'],
            'origen' => $vuelo['origen'],
            'destino' => $vuelo['destino'],
            'fecha_salida' => $vuelo['fecha_salida'],
            'fecha_llegada' => $vuelo['fecha_llegada'],
            'precio' => $vuelo['precio']
        ];
    }

    // Procesar los paquetes turísticos
    foreach ($paquetes['paquetes'] as $paquete){
        $response['paquetes'][] = [
            'id' => $paquete['id'],
            'nombre' => $paquete['nombre'],
            'descripcion' => $paquete['descripcion'],
            'precio' => $paquete['precio'],
            'ciudad' => $paquete['ciudad'],
            'imagen' => $paquete['imagen']
        ];
    }
    foreach ($hoteles as $hotel) {
        $response['hoteles'][] = [ 
            'id' => $hotel->getID(),
            'nombre' => $hotel->getNombre(),
            'direccion' => $hotel->getDireccion(),
            'categoria' => $hotel->getCategoria(),
            'telefono' => $hotel->getTelefono(),
            'precio_por_noche' => $hotel->getPrecioPorNoche(),
            'imagen' => $hotel->getImagen()
        ];
    }
    foreach ($transportes as $transporte) {
        $response['transportes'][] = [ 
            'id' => $transporte->getID(),
            'tipo' => $transporte->getTipo(),
            'costo' => $transporte->getCosto(),
            'empresa' => $transporte->getEmpresa(),
        ];
    }
    foreach ($servicios as $servicio) {
        $response['servicios'][] = [ 
            'id' => $servicio->getID(),
            'costo' => $servicio->getCosto(),
            'descripcion' => $servicio->getdescripcion(),
        ];
    }
    foreach ($guiasturisticos as $guiaturistico) {
        $response['guiasturisticos'][] = [ 
            'id' => $guiaturistico->getID(),
            'nombre' => $guiaturistico->getnombre(),
            'telefono' => $guiaturistico->gettelefono(),
            'idioma' => $guiaturistico->getidioma()
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$ciudadModel = new CiudadModel();
$ciudades = $ciudadModel->getAll();

// Pasar los datos a la vista
$data = [
    'title' => 'Plan your next adventure',
    'ciudades' => $ciudades
];

// Estilos y scripts específicos de esta vista
$styles = ['trip']; // Cargará /assets/public/css/trip.css
$scripts = ['trip']; // Cargará /assets/puclic/js/trip.js

// Renderizar la vista
renderFront('public/views/viajes/index.php', $data, $styles, $scripts);
