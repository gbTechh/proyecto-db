<?php 

class HomeController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->layout->setLayout('default');
        // Añadir estilos si los necesitas
        $this->layout->addStyle('home');
    }

    public function index() {
        
        $data = [
            'title' => 'Bienvenido',
            'description' => 'Página de inicio'
        ];

        // Añade logs para debugging
        error_log("HomeController->index() ejecutándose");
        error_log("Data: " . print_r($data, true));

        $this->view('home/index', $data);
        
    }
}