<?php
require '../init.php';
require ROOT . '/models/Ciudad.php';
require ROOT . '/models/CiudadModel.php';
require ROOT . '/models/Vuelo.php';
require ROOT . '/models/VueloModel.php';
require ROOT . '/models/PaqueteTuristico.php';
require ROOT . '/models/PaqueteTuristicoModel.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data) {
        throw new Exception('Error al decodificar los datos JSON'); 
    }

    $origen = $data['origin'] ?? '';
    $destino = $data['destination'] ?? '';
    $fechaInicio = $data['start_date'] ?? '';
    $fechaFin = $data['end_date'] ?? '';

    $vueloModel = new VueloModel();
    $vuelos = $vueloModel->buscarVuelos($origen, $destino, $fechaInicio, $fechaFin);

    // Preparar la respuesta con los vuelos de ida y regreso
    $response = [
        'ida' => [],
        'regreso' => []
    ];

    // Procesar los vuelos de ida
    foreach ($vuelos['ida'] as $vuelo) {
        $response['ida'][] = [
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
        $response['regreso'][] = [
            'id' => $vuelo['id'],
            'num_vuelo' => $vuelo['num_vuelo'],
            'origen' => $vuelo['origen'],
            'destino' => $vuelo['destino'],
            'fecha_salida' => $vuelo['fecha_salida'],
            'fecha_llegada' => $vuelo['fecha_llegada'],
            'precio' => $vuelo['precio']
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