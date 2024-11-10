<?php 

class ErrorController extends Controller {
  public function index($message = 'Página no encontrada') {
    $data = [
        'title' => 'Error',
        'message' => $message
    ];
    $this->view('error/index', $data);
  }
}