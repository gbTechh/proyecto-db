<?php
require_once ROOT . '/app/models/Vuelo.php';
require_once ROOT . '/app/models/VueloModel.php';

class VuelosController extends AdminController {
    private $vuelosModel;

    public function __construct() {
        parent::__construct();
        $this->vuelosModel = new VueloModel();
        $this->layout->addStyle('admin/vuelos');
        $this->layout->addScript('admin/vuelos');
    }

    // Listar reservas
    public function index() {
        try {
            $vuelos = $this->vuelosModel->getAll();
            
            $data = [
              'title' => 'Lista de todos los vuelos disponibles',
              'vuelos' => $vuelos
            ];
            $this->view('admin/vuelos/index', $data);
        } catch (Exception $e) {
            $this->view('error/index', ['message' => $e->getMessage()]);
        }
    }

   
  
   
}