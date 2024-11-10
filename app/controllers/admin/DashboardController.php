<?php
class DashboardController extends AdminController {
  public function __construct() {
    parent::__construct();
    // Añadir estilos específicos del dashboard
    $this->layout->addStyle('admin/dashboard');
  }

  public function index() {
    // Aquí podrías cargar datos para el dashboard
    $data = [
      'title' => 'Panel de Administración Dashboard',
      'totalUsers' => 100, // Ejemplo
      'totalProducts' => 50, // Ejemplo
      'recentOrders' => [] // Ejemplo
    ];

    // Renderizar la vista del dashboard
    $this->view('admin/dashboard/index', $data);
  }
}