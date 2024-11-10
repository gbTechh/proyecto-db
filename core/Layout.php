<?php 

class Layout {
    private $sections = [];
    private $layout = 'default';
    private $styles = [];
    private $scripts = [];
    private $globalStyles = ['main'];

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function addStyle($stylesheet) {
      if (!in_array($stylesheet, $this->styles)) {
        $this->styles[] = $stylesheet;
      }
    }

    public function addScript($script) {
      if (!in_array($script, $this->scripts)) {
        $this->scripts[] = $script;
      }
    }

    public function renderStyles() {
      foreach ($this->globalStyles as $style) {
        echo "<link rel='stylesheet' href='" . URLROOT . "/css/{$style}.css'>\n";
      }
      foreach ($this->styles as $style) {
            echo "<link rel='stylesheet' href='" . URLROOT . "/css/{$style}.css'>\n";
        }
    }

    public function renderScripts() {
      foreach ($this->scripts as $script) {
        echo "<script src='" . URLROOT . "/js/{$script}.js'></script>\n";
      }
    }

    public function start($name) {
        ob_start();
    }

    public function end($name) {
        $this->sections[$name] = ob_get_clean();
    }

    public function content($name) {
        return $this->sections[$name] ?? '';
    }

    public function render($view, $data = []) {
      // Extraer los datos para que estén disponibles en la vista
      extract($data);

      // Capturar el contenido de la vista
      ob_start();
      $viewFile = ROOT . '/app/views/' . $view . '.php';
      if (file_exists($viewFile)) {
          require_once $viewFile;
      } else {
          die("Vista no encontrada: " . $viewFile);
      }
      $content = ob_get_clean();

      // Cargar el layout
      $layoutFile = ROOT . '/app/views/layouts/' . $this->layout . '.php';
      if (file_exists($layoutFile)) {
          require_once $layoutFile;
      } else {
          die("Layout no encontrado: " . $layoutFile);
      }
    }
}

