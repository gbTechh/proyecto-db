<?php 
require_once ROOT . '/app/views/templates/TableHelper.php';

?>
<div class="dashboard">
  <h1><?php echo $title; ?></h1>
  <!-- Contenido del Dashboard -->

  <?php
  // Definir las cabeceras y sus correspondientes claves
  $headers = [
      'id' => 'ID',
      'nombre' => 'Nombre',
      'direccion' => 'Direccion',
      'telefono' => 'Telefono',
  ];

  // Configuración personalizada
 $config = [
      'tableId' => 'sucursalesTable',
      'itemsPerPage' => 5,
      'searchable' => true,
      'actions' => true,
      'actionButtons' => ['edit', 'delete'],
       'actionUrls' => [
        'edit' => URLROOT . '/admin/sucursal/editar/',     // Agregará el DNI al final
        'delete' => URLROOT . '/admin/sucursal/eliminar/'  // Agregará el DNI al final
      ]
  ];

  // Renderizar la tabla
  echo TableHelper::render($headers, $sucursales, $config);
  ?>
  
</div>

