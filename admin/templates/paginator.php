<?php 


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