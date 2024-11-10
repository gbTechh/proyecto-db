<?php
require_once ROOT . '/app/models/Cliente.php';
require_once ROOT . '/app/models/ClienteModel.php';

class ClientesController extends AdminController {
    private $clienteModel;

    public function __construct() {
        parent::__construct();
        $this->clienteModel = new ClienteModel();
        $this->layout->addStyle('admin/clientes');
        $this->layout->addScript('admin/clientes');
    }

    // Listar clientes
    public function index() {
        try {
            $clientes = $this->clienteModel->getAll();
            
            $data = [
              'title' => 'Lista de Clientes',
              'clientes' => $clientes
            ];
            $this->view('admin/clientes/index', $data);
        } catch (Exception $e) {
            $this->view('error/index', ['message' => $e->getMessage()]);
        }
    }

    public function crear() {
        $data = [
            'title' => 'Crear Cliente',
            'errors' => [],
            'old' => [] // Para mantener los datos del formulario
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validar datos
                $errors = $this->validarDatos($_POST);
                
                if (empty($errors)) {
                    // Crear cliente
                    $cliente = new Cliente(
                        $_POST['dni'],
                        $_POST['nombre'],
                        $_POST['apellidos'],
                        $_POST['email'],
                        $_POST['telefono'],
                        $_POST['username'],
                        $_POST['password'],
                    );

                    $this->clienteModel->crear($cliente);
                    
                    // Redirigir con mensaje de éxito
                    $_SESSION['success'] = 'Cliente creado exitosamente';
                    header('Location: ' . URLROOT . '/admin/clientes');
                    exit;
                } else {
                    // Si hay errores, mantener los datos del formulario
                    $data['errors'] = $errors;
                    $data['old'] = $_POST;
                }
            } catch (Exception $e) {
                $data['errors'][] = $e->getMessage();
                $data['old'] = $_POST;
            }
        }

        $this->view('admin/clientes/crear', $data);
    }

    private function validarDatos($data) {
        $errors = [];

        // Validar DNI
        if (empty($data['dni'])) {
            $errors['dni'] = 'El dni es requerido';
        } elseif (strlen($data['dni']) > 9) {
            $errors['dni'] = 'El dni no puede exceder 8 caracteres';
        }

        // Validar nombre
        if (empty($data['nombre'])) {
            $errors['nombre'] = 'El nombre es requerido';
        } elseif (strlen($data['nombre']) > 50) {
            $errors['nombre'] = 'El nombre no puede exceder 50 caracteres';
        }

        // Validar apellidos
        if (empty($data['apellidos'])) {
            $errors['apellidos'] = 'El apellido es requerido';
        }

        // Validar email
        if (empty($data['email'])) {
            $errors['email'] = 'El email es requerido';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El email no es válido';
        } elseif ($this->clienteModel->existeEmail($data['email'])) {
            $errors['email'] = 'Este email ya está registrado';
        }

        // Validar teléfono (opcional)
        if (!empty($data['telefono']) && !preg_match('/^[0-9]{9}$/', $data['telefono'])) {
            $errors['telefono'] = 'El teléfono debe tener 9 dígitos';
        }

        return $errors;
    }
    
}