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

    
}