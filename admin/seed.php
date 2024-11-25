<?php
require '../init.php';
require ROOT . '/models/Cliente.php';
require ROOT . '/models/ClienteModel.php';

$clienteModel = new ClienteModel();

// Array con los datos de los clientes
$clientes_data = [
    [
        'dni' => '12345671',
        'nombre' => 'Luis',
        'apellidos' => 'Rodríguez Pérez',
        'telefono' => '998777666',
        'email' => 'luis@email.com',
        'username' => 'lrodri',
        'password' => 'cpass123'
    ],
    [
        'dni' => '12345672',
        'nombre' => 'Carmen',
        'apellidos' => 'Díaz García',
        'telefono' => '998777667',
        'email' => 'carmen@email.com',
        'username' => 'cdiaz',
        'password' => 'cpass124'
    ],
    [
        'dni' => '12345673',
        'nombre' => 'Jorge',
        'apellidos' => 'Flores López',
        'telefono' => '998777668',
        'email' => 'jorge@email.com',
        'username' => 'jflores',
        'password' => 'cpass125'
    ],
    [
        'dni' => '12345674',
        'nombre' => 'Laura',
        'apellidos' => 'Torres Ruiz',
        'telefono' => '998777669',
        'email' => 'laura@email.com',
        'username' => 'ltorres',
        'password' => 'cpass126'
    ],
    [
        'dni' => '12345675',
        'nombre' => 'Miguel',
        'apellidos' => 'Castro Silva',
        'telefono' => '998777670',
        'email' => 'miguel@email.com',
        'username' => 'mcastro',
        'password' => 'cpass127'
    ],
    [
        'dni' => '12345676',
        'nombre' => 'Gabriel',
        'apellidos' => 'Lopez Mendez',
        'telefono' => '998777670',
        'email' => 'gab@email.com',
        'username' => 'glopez',
        'password' => 'cpass127'
    ],
    [
        'dni' => '12345677',
        'nombre' => 'Luis',
        'apellidos' => 'Fernandez Calapuja',
        'telefono' => '998777670',
        'email' => 'lucho@email.com',
        'username' => 'luchito',
        'password' => 'cpass127'
    ]
];

// Insertar cada cliente
foreach ($clientes_data as $cliente_data) {
    // Crear nueva instancia de Cliente con la contraseña hasheada
    $nuevoCliente = new Cliente(
        $cliente_data['dni'],
        $cliente_data['nombre'],
        $cliente_data['apellidos'],
        $cliente_data['telefono'],
        $cliente_data['email'],
        $cliente_data['username'],
        password_hash($cliente_data['password'], PASSWORD_BCRYPT)
    );
    
    // Insertar el cliente
    $clienteModel->crear($nuevoCliente);
}

echo "Clientes insertados correctamente!";