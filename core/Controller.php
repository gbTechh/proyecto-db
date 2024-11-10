<?php

class Controller {
    protected $layout;
    protected $view;
    protected $model;

    public function __construct() {
        $this->layout = new Layout();
    }

    protected function loadModel() {
        // Obtener nombre del modelo basado en el controlador
        $modelName = str_replace('Controller', 'Model', get_class($this));
        $modelFile = ROOT . '/app/models/' . $modelName . '.php';
        print $modelFile;
        if (file_exists($modelFile)) {
            require_once $modelFile;
            $this->model = new $modelName();
        }
    }

    public function view($view, $data = []) {
      if(file_exists(ROOT . '/app/views/' . $view . '.php')) {
        $this->layout->render($view, $data);
      } else {
        die("Vista no encontrada: " . ROOT . '/app/views/' . $view . '.php');
      }
    }
}