<?php
class TableHelper {
    public static function render($headers, $data, $config = []) {
        // Configuración por defecto
        $defaultConfig = [
            'tableId' => 'dataTable_' . uniqid(),
            'itemsPerPage' => 10,
            'searchable' => true,
            'actions' => true,
            'actionButtons' => ['edit', 'delete'],
            'fetchUrl' => '', // URL para obtener datos
            'actionUrls' => [
                'edit' => URLROOT . '/admin/empleados/editar/',
                'delete' => URLROOT . '/admin/empleados/eliminar/'
            ]
        ];

        $config = array_merge($defaultConfig, $config);
        ob_start();
        ?>
        <style>
            /* Estilos de la tabla */
            .simple-table-container {
                width: 100%;
                margin: 20px 0;
                font-family: Arial, sans-serif;
            }

            .simple-search {
                width: 100%;
                padding: 8px;
                margin-bottom: 16px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .simple-table {
                width: 100%;
                border-collapse: collapse;
                background: white;
                box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            }

            .simple-table th {
                background: #f4f4f4;
                padding: 12px;
                text-align: left;
                font-weight: bold;
                color: #333;
                border-bottom: 2px solid #ddd;
            }

            .simple-table td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
                color: #666;
            }

            .simple-table tr:hover {
                background: #f9f9f9;
            }

            /* Estilos de botones de acción */
            .simple-button {
                display: inline-block;
                padding: 6px 12px;
                margin: 0 4px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-decoration: none;
                font-size: 14px;
            }

            .simple-button-edit {
                background: #ffd700;
                color: #333;
            }

            .simple-button-delete {
                background: #ff4444;
                color: white;
            }

            /* Estilos de paginación */
            .simple-pagination {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
                gap: 8px;
            }

            .simple-pagination button {
                padding: 8px 12px;
                border: 1px solid #ddd;
                background: white;
                cursor: pointer;
                border-radius: 4px;
            }

            .simple-pagination button:hover {
                background: #f4f4f4;
            }

            .simple-pagination button.active {
                background: #4CAF50;
                color: white;
                border-color: #4CAF50;
            }

            .simple-pagination button:disabled {
                background: #f4f4f4;
                cursor: not-allowed;
                color: #999;
            }

            @media (max-width: 768px) {
                .simple-table {
                    display: block;
                    overflow-x: auto;
                }

                .simple-button {
                    padding: 4px 8px;
                    font-size: 12px;
                }
            }
        </style>

  <div class="simple-table-container">
            <?php if ($config['searchable']): ?>
                <input type="text" 
                       class="simple-search" 
                       id="search_<?php echo $config['tableId']; ?>" 
                       placeholder="Buscar...">
            <?php endif; ?>

            <div class="table-wrapper">
                <table id="<?php echo $config['tableId']; ?>" class="simple-table">
                    <thead>
                        <tr>
                            <?php foreach ($headers as $header): ?>
                                <th><?php echo $header; ?></th>
                            <?php endforeach; ?>
                            
                            <?php if ($config['actions']): ?>
                                <th>Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Los datos se cargarán vía AJAX -->
                    </tbody>
                </table>
            </div>

            <div id="pagination_<?php echo $config['tableId']; ?>" class="simple-pagination"></div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableId = '<?php echo $config['tableId']; ?>';
            const table = document.getElementById(tableId);
            const tableWrapper = table.closest('.table-wrapper');
            const tbody = table.querySelector('tbody');
            const searchInput = document.getElementById('search_' + tableId);
            const paginationContainer = document.getElementById('pagination_' + tableId);
            const itemsPerPage = <?php echo $config['itemsPerPage']; ?>;
            const fetchUrl = '<?php echo $config['fetchUrl']; ?>';
            const actionUrls = <?php echo json_encode($config['actionUrls']); ?>;

            let currentPage = 1;
            let loading = false;

            // Función para mostrar/ocultar loading
            function toggleLoading(show) {
                if (show) {
                    tableWrapper.classList.add('table-loading');
                } else {
                    tableWrapper.classList.remove('table-loading');
                }
                loading = show;
            }

            // Función para cargar datos
            async function loadData(page = 1, search = '') {
                if (loading) return;
                
                toggleLoading(true);
                try {
                    const params = new URLSearchParams({
                        page: page,
                        limit: itemsPerPage
                    });

                    if (search) {
                        params.append('search', search);
                    }

                    const response = await fetch(`${fetchUrl}?${params}`);
                    if (!response.ok) throw new Error('Error en la petición');
                    
                    const data = await response.json();
                    renderTable(data.data);
                    renderPagination(data.totalPages, data.currentPage);
                    
                } catch (error) {
                    console.error('Error:', error);
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="${Object.keys(<?php echo json_encode($headers); ?>).length + 1}">
                                Error al cargar los datos
                            </td>
                        </tr>
                    `;
                } finally {
                    toggleLoading(false);
                }
            }

            // Función para renderizar la tabla
            function renderTable(data) {
                const headerKeys = Object.keys(<?php echo json_encode($headers); ?>);
                
                tbody.innerHTML = data.map(item => `
                    <tr>
                        ${headerKeys.map(key => `
                            <td>${item[key]}</td>
                        `).join('')}
                        <?php if ($config['actions']): ?>
                            <td>
                                ${Object.entries(actionUrls).map(([action, url]) => `
                                    <a href="${url}${item.dni}" 
                                       class="simple-button simple-button-${action}"
                                       ${action === 'delete' ? 'onclick="return confirm(\'¿Estás seguro?\')"' : ''}>
                                        ${action.charAt(0).toUpperCase() + action.slice(1)}
                                    </a>
                                `).join('')}
                            </td>
                        <?php endif; ?>
                    </tr>
                `).join('');
            }

            // Función para renderizar la paginación
            function renderPagination(totalPages, currentPage) {
                if (totalPages <= 1) {
                    paginationContainer.innerHTML = '';
                    return;
                }

                let html = '';
                
                // Botón Anterior
                html += `
                    <button ${currentPage === 1 ? 'disabled' : ''} 
                            onclick="changePage(${currentPage - 1})">
                        Anterior
                    </button>
                `;

                // Primera página
                html += `
                    <button ${currentPage === 1 ? 'class="active"' : ''} 
                            onclick="changePage(1)">1</button>
                `;

                // Puntos suspensivos iniciales
                if (currentPage > 3) {
                    html += '<span>...</span>';
                }

                // Páginas centrales
                for (let i = Math.max(2, currentPage - 1); 
                     i <= Math.min(totalPages - 1, currentPage + 1); i++) {
                    if (i === 1 || i === totalPages) continue;
                    html += `
                        <button ${currentPage === i ? 'class="active"' : ''} 
                                onclick="changePage(${i})">${i}</button>
                    `;
                }

                // Puntos suspensivos finales
                if (currentPage < totalPages - 2) {
                    html += '<span>...</span>';
                }

                // Última página
                if (totalPages > 1) {
                    html += `
                        <button ${currentPage === totalPages ? 'class="active"' : ''} 
                                onclick="changePage(${totalPages})">${totalPages}</button>
                    `;
                }

                // Botón Siguiente
                html += `
                    <button ${currentPage === totalPages ? 'disabled' : ''} 
                            onclick="changePage(${currentPage + 1})">
                        Siguiente
                    </button>
                `;

                paginationContainer.innerHTML = html;
            }

            // Función para cambiar de página
            window.changePage = function(page) {
                currentPage = page;
                loadData(page, searchInput ? searchInput.value : '');
            }

            // Manejar búsqueda
            if (searchInput) {
                let debounceTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(() => {
                        currentPage = 1;
                        loadData(1, this.value);
                    }, 300);
                });
            }

            // Cargar datos iniciales
            loadData(1);
        });
        </script>
        <?php
        return ob_get_clean();
    }
}