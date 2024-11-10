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

}