<?php
require_once ROOT . '/app/models/Ciudad.php';
require_once ROOT . '/app/models/CiudadModel.php';

class CiudadesController extends AdminController {
    private $ciudadModel;

    public function __construct() {
        parent::__construct();
        $this->ciudadModel = new CiudadModel();
        $this->layout->addStyle('admin/ciudades');
        $this->layout->addScript('admin/ciudades');
    }

    // Listar reservas
    public function index() {
        try {
            $ciudades = $this->ciudadModel->getAll();
            
            $data = [
              'title' => 'Lista de todas los ciudades disponibles',
              'ciudades' => $ciudades
            ];
            $this->view('admin/ciudades/index', $data);
        } catch (Exception $e) {
            $this->view('error/index', ['message' => $e->getMessage()]);
        }
    }

   
  
   
}