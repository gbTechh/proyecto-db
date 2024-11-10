<?php


// También podrías crear una función helper
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

