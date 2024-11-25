<?php 

function render($view, $data = [], $styles = [], $scripts = []) {
    // Capturar el contenido de la vista
    ob_start();
    extract($data);
    require $view;
    $content = ob_get_clean();
    
    // Incluir el layout con el contenido capturado
    require 'admin/layouts/admin.php';
}

function renderLogin($view, $data = [], $styles = [], $scripts = []) {
    // Capturar el contenido de la vista
    ob_start();
    extract($data);
    require $view;
    $content = ob_get_clean();
    
    // Incluir el layout con el contenido capturado
    require 'admin/layouts/login.php';
}

function renderFront($view, $data = [], $styles = [], $scripts = []) {
    // Capturar el contenido de la vista
    ob_start();
    extract($data);
    require $view;
    $content = ob_get_clean();
    
    // Incluir el layout con el contenido capturado
    require 'public/layouts/front.php';
}

function formatearFecha($fecha) {
    if (!$fecha instanceof DateTime) {
        $fecha = new DateTime($fecha);
    }
    
    $meses = [
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    ];
    
    return $fecha->format('d') . ' de ' . 
           $meses[(int)$fecha->format('n')] . ' del ' . 
           $fecha->format('Y');
}

function subirImagen($archivo, $directorio_destino = ROOT. "/uploads/", $tamano_maximo = 5242880) {
    try {
       
        // Validar que se recibió un archivo
        if (!isset($archivo) || !is_array($archivo)) {
            throw new Exception("No se recibió ningún archivo.");
        }

        // Obtener información del archivo
        $nombre_archivo = $archivo["name"];
        $tipo_archivo = $archivo["type"];
        $tamano_archivo = $archivo["size"];
        $temp_archivo = $archivo["tmp_name"];
        $error_archivo = $archivo["error"];

        // Tipos de archivo permitidos
        $permitidos = array("image/jpeg", "image/jpg", "image/png", "image/gif");

        if ($error_archivo !== 0) {
            throw new Exception("Error al subir el archivo. Código: " . $error_archivo);
        }

        if (!in_array($tipo_archivo, $permitidos)) {
            throw new Exception("Tipo de archivo no permitido. Solo se permiten imágenes JPG, PNG y GIF.");
        }

        if ($tamano_archivo > $tamano_maximo) {
            throw new Exception("El archivo es demasiado grande. Máximo permitido: " . ($tamano_maximo / 1024 / 1024) . "MB.");
        }

        // Generar nombre único
        $nombre_unico = uniqid() . '_' . $nombre_archivo;
        $ruta_destino = $directorio_destino . $nombre_unico;

        // Mover el archivo
        if (!move_uploaded_file($temp_archivo, $ruta_destino)) {
            throw new Exception("Error al mover el archivo al directorio de destino.");
        }

        return [
            'success' => true,
            'mensaje' => "Imagen subida correctamente",
            'nombre_archivo' => $nombre_unico,
            'ruta_completa' => $ruta_destino
        ];

    } catch (Exception $e) {
        return [
            'success' => false,
            'mensaje' => $e->getMessage()
        ];
    }
}

class Paginator {
    private $total_items;
    private $items_per_page;
    private $current_page;
    private $total_pages;
    private $url_pattern;

    public function __construct($total_items, $current_page = 1, $items_per_page = 10) {
        $this->total_items = $total_items;
        $this->items_per_page = $items_per_page;
        $this->current_page = $current_page;
        $this->total_pages = ceil($total_items / $items_per_page);
        $this->url_pattern = '?page=[[PAGE]]&per_page=' . $items_per_page;
    }

    public function getOffset() {
        return ($this->current_page - 1) * $this->items_per_page;
    }

    public function render() {
        if ($this->total_pages <= 1) return '';

        $html = '<form class="pagination-form" method="GET">';
        $html .= '<div class="pagination-controls">';
        
        // Botón "Previous"
        if ($this->current_page > 1) {
            $html .= '<a href="' . str_replace('[[PAGE]]', ($this->current_page - 1), $this->url_pattern) . '" class="pagination-button">Previous</a>';
        }

        // Números de página
        $pages = $this->getPageNumbers();
        foreach ($pages as $page) {
            if ($page === '...') {
                $html .= '<span class="pagination-ellipsis">...</span>';
            } else {
                $class = ($page == $this->current_page) ? 'pagination-button active' : 'pagination-button';
                $html .= '<a href="' . str_replace('[[PAGE]]', $page, $this->url_pattern) . '" class="' . $class . '">' . $page . '</a>';
            }
        }

        // Botón "Next"
        if ($this->current_page < $this->total_pages) {
            $html .= '<a href="' . str_replace('[[PAGE]]', ($this->current_page + 1), $this->url_pattern) . '" class="pagination-button">Next</a>';
        }

        // Selector de items por página
        $html .= '<div class="items-per-page">';
        $html .= '<select name="per_page" onchange="this.form.submit()">';
        foreach ([10, 25, 50, 100] as $value) {
            $selected = ($value == $this->items_per_page) ? 'selected' : '';
            $html .= "<option value='{$value}' {$selected}>{$value} / page</option>";
        }
        $html .= '</select>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</form>';

        return $html;
    }

    private function getPageNumbers() {
        $pages = [];
        
        if ($this->total_pages <= 7) {
            // Si hay 7 o menos páginas, mostrar todas
            for ($i = 1; $i <= $this->total_pages; $i++) {
                $pages[] = $i;
            }
        } else {
            // Siempre mostrar primera página
            $pages[] = 1;
            
            if ($this->current_page <= 3) {
                // Si estamos cerca del inicio
                for ($i = 2; $i <= 4; $i++) {
                    $pages[] = $i;
                }
                $pages[] = '...';
            } else if ($this->current_page >= $this->total_pages - 2) {
                // Si estamos cerca del final
                $pages[] = '...';
                for ($i = $this->total_pages - 3; $i < $this->total_pages; $i++) {
                    $pages[] = $i;
                }
            } else {
                // En medio
                $pages[] = '...';
                for ($i = $this->current_page - 1; $i <= $this->current_page + 1; $i++) {
                    $pages[] = $i;
                }
                $pages[] = '...';
            }
            
            // Siempre mostrar última página
            $pages[] = $this->total_pages;
        }
        
        return $pages;
    }
}