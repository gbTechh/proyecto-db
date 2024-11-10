<?php
require_once ROOT . '/app/models/Empleado.php';
require_once ROOT . '/app/models/EmpleadoModel.php';

class EmpleadosController extends AdminController {
    private $empleadoModel;

    public function __construct() {
        parent::__construct();
        $this->empleadoModel = new EmpleadoModel();
        $this->layout->addStyle('admin/empleados');
        $this->layout->addScript('admin/empleados');
    }

    // Listar empleados
    public function index() {
        try {
            $empleados = $this->empleadoModel->getAll();
            
            $data = [
              'title' => 'Lista de Empleados',
              'empleados' => $empleados
            ];
            $this->view('admin/empleados/index', $data);
        } catch (Exception $e) {
            $this->view('error/index', ['message' => $e->getMessage()]);
        }
    }

    public function getEmpleados() {
        try {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            $result = $this->empleadoModel->getPaginated($page, $limit, $search);
            
            header('Content-Type: application/json');
            echo json_encode($result);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    // Crear empleado
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $empleado = new Empleado(
                $_POST['dni'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['telefono'],
                $_POST['id_sucursal'],
                $_POST['puesto'],
                $_POST['username'],
                password_hash($_POST['password'], PASSWORD_DEFAULT)
            );

            if ($this->empleadoModel->crear($empleado)) {
                header('Location: ' . URLROOT . '/empleado?success=1');
                exit;
            }
        }

        $this->view('empleados/crear', ['title' => 'Crear Empleado']);
    }

    // Ver empleado
    public function ver($dni) {
        $empleado = $this->empleadoModel->getByDni($dni);
        if ($empleado) {
            $this->view('empleados/ver', [
                'title' => 'Ver Empleado',
                'empleado' => $empleado
            ]);
        } else {
            $this->view('error/index', ['message' => 'Empleado no encontrado']);
        }
    }
}