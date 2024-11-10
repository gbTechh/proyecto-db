<?php

class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];


    public function __construct() {
      try {
        $url = $this->getUrl();
        
        if($url === false || empty($url)) {
            $this->loadDefaultController();
            if(method_exists($this->controller, $this->method)) {
                call_user_func_array([$this->controller, $this->method], $this->params);
            } else {
                throw new Exception("Método por defecto no encontrado");
            }
            return;
        }

        if($url[0] === 'admin') {
            array_shift($url);
            $this->loadAdminController($url);
        } else {
            $this->loadFrontController($url);
        }

        if(method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            throw new Exception("Método {$this->method} no encontrado");
        }
          
      } catch (Exception $e) {
        error_log("Error en Router: " . $e->getMessage());
        $this->handleError($e->getMessage());
      }
    }

    private function loadDefaultController() {
        $file = ROOT . '/app/controllers/' . $this->controller . '.php';
        if(file_exists($file)) {
            require_once $file;
            $this->controller = new $this->controller();
        } else {
            $this->handleError("Error: Controlador por defecto no encontrado");
        }
    }

    private function loadAdminController($url) {
      // Primero cargar el controlador base de admin
      $adminFile = ROOT . '/app/controllers/admin/AdminController.php';
      if(!file_exists($adminFile)) {
          throw new Exception("AdminController base no encontrado");
      }
      require_once $adminFile;

      if(!empty($url[0])) {
        // Construir nombre del controlador
        $controllerName = ucfirst($url[0]) . 'Controller';
        $file = ROOT . '/app/controllers/admin/' . $controllerName . '.php';
        
        if(file_exists($file)) {
            require_once $file;
            // Verificar que la clase existe después de cargar el archivo
            if(class_exists($controllerName)) {

                $this->controller = new $controllerName();
                unset($url[0]);
                $this->processMethodAndParams($url);
            } else {
                throw new Exception("Clase {$controllerName} no encontrada");
            }
        } else {
            throw new Exception("Archivo del controlador admin no encontrado: " . $file);
        }
      } else {
        // Si solo es /admin, cargar DashboardController
        $file = ROOT . '/app/controllers/admin/DashboardController.php';
        if(file_exists($file)) {
            require_once $file;
            $this->controller = new DashboardController();
        } else {
            throw new Exception("Controlador Dashboard no encontrado");
        }
      }
    }

    private function loadFrontController($url) {
        // Construir nombre del controlador
        $controllerName = ucfirst($url[0]) . 'Controller';
        $file = ROOT . '/app/controllers/' . $controllerName . '.php';

        if(file_exists($file)) {
            require_once $file;

            $this->controller = $controllerName;

            $this->controller = new $this->controller();
            unset($url[0]);
            // Procesar método y parámetros
            $this->processMethodAndParams($url);
        } else {
            $this->handleError("Error: Controlador no encontrado");
        }
    }

    private function processMethodAndParams($url) {
        // Verificar método
        if(!empty($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->handleError("Error: Método no encontrado");
            }
        }

        // Obtener parámetros
        $this->params = $url ? array_values($url) : [];
    }

    private function handleError($message) {
        // Cargar controlador de errores
        $file = ROOT . '/app/controllers/ErrorController.php';
        if(file_exists($file)) {
            require_once $file;
            $this->controller = new ErrorController();
            $this->method = 'index';
            $this->params = [$message];
        } else {
            die($message);
        }
    }

    protected function getUrl() {
        // Si no hay URL, devolver false explícitamente
        if(!isset($_GET['url'])) {
            return false;
        }
        
        $url = rtrim($_GET['url'], '/');
        if(empty($url)) {
            return false;
        }
        
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}