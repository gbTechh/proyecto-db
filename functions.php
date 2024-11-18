<?php 

function render($view, $data = [], $styles = [], $scripts = []) {
    // Capturar el contenido de la vista
    ob_start();
    extract($data);
    require $view;
    $content = ob_get_clean();
    
    // Incluir el layout con el contenido capturado
    require 'admin/layouts/admin.php';
}
function renderFront($view, $data = [], $styles = [], $scripts = []) {
    // Capturar el contenido de la vista
    ob_start();
    extract($data);
    require $view;
    $content = ob_get_clean();
    
    // Incluir el layout con el contenido capturado
    require 'public/layouts/front.php';
}

function formatearFecha($fecha) {
    if (!$fecha instanceof DateTime) {
        $fecha = new DateTime($fecha);
    }
    
    $meses = [
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    ];
    
    return $fecha->format('d') . ' de ' . 
           $meses[(int)$fecha->format('n')] . ' del ' . 
           $fecha->format('Y');
}
