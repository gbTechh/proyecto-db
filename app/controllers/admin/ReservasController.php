<?php
require_once ROOT . '/app/models/Reservas.php';
require_once ROOT . '/app/models/ReservasModel.php';

class ReservasController extends AdminController {
    private $reservaModel;

    public function __construct() {
        parent::__construct();
        $this->reservaModel = new ReservaModel();
        $this->layout->addStyle('admin/reservas');
        $this->layout->addScript('admin/reservas');
    }

    // Listar reservas
    public function index() {
        try {
            $reservas = $this->reservaModel->getAll();
            
            $data = [
              'title' => 'Lista de reservas',
              'reservas' => $reservas
            ];
            $this->view('admin/reservas/index', $data);
        } catch (Exception $e) {
            $this->view('error/index', ['message' => $e->getMessage()]);
        }
    }

   
  
   
}