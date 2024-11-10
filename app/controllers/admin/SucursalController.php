<?php
require_once ROOT . '/app/models/Sucursal.php';
require_once ROOT . '/app/models/SucursalModel.php';

class SucursalController extends AdminController {
  private $sucursalModel;

  public function __construct() {
      parent::__construct();
      $this->sucursalModel = new SucursalModel();
      $this->layout->addStyle('admin/sucursal');
  }

  // Listar sucursals
  public function index() {
      try {
          $sucursales = $this->sucursalModel->getAll();
          
          $data = [
            'title' => 'Lista de sucursales',
            'sucursales' => $sucursales
          ];
          $this->view('admin/sucursal/index', $data);
      } catch (Exception $e) {
          $this->view('error/index', ['message' => $e->getMessage()]);
      }
  }
  public function crear() {
    $data = [
        'title' => 'Crear Sucursal',
        'errors' => [],
        'old' => [] // Para mantener los datos del formulario
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Validar datos
            $errors = $this->validarDatos($_POST);
            if (empty($errors)) {
                // Crear Sucursal
                $sucursal = new Sucursal(
                    $_POST['ID_sucursal'],
                    $_POST['direccion'],
                    $_POST['telefono'],
                    $_POST['nombre'],
                );
                $this->sucursalModel->crear($sucursal);
                
                // Redirigir con mensaje de éxito
                $_SESSION['success'] = 'Sucursal creada exitosamente';
                header('Location: ' . URLROOT . '/admin/sucursal');
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

    $this->view('admin/sucursal/crear', $data);
  }

  
  private function validarDatos($data) {
    $errors = [];

    // Validar nombre de sucursal
    if (empty($data['nombre'])) {
      $errors['nombre'] = 'El nombre es requerido';
    } elseif (strlen($data['nombre']) > 50) {
      $errors['nombre'] = 'El nombre no puede exceder 50 caracteres';
    } elseif ($this->sucursalModel->existeNombre($data['nombre'], isset($data['ID_sucursal']) ? $data['ID_sucursal'] : null)) {
      $errors['nombre'] = 'Ya existe una sucursal con ese nombre';
    }

    // Validar direccion
    if (empty($data['direccion'])) {
      $errors['direccion'] = 'La direccion es requerida';
    } elseif (strlen($data['direccion']) > 50) {
      $errors['direccion'] = 'La direccion no puede exceder 50 caracteres';
    }
    // Validar teléfono (obligatorio)
    if (empty($data['telefono'])) {
      $errors['telefono'] = 'El teléfono es requerido';
    } elseif (!preg_match('/^[0-9]{9}$/', $data['telefono'])) {
      $errors['telefono'] = 'El teléfono debe tener 9 dígitos';
    }

    return $errors;
  }

}