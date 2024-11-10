<?php 
require_once ROOT . '/app/views/templates/TableHelper.php';

?>

<div class="dashboard">
  <h1 class="title"><?php echo $title; ?></h1>
  <!-- Contenido del Dashboard -->
  <table id="miTabla" class="display table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Sucursal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empleados as $empleado) {
           echo "<tr>";
            echo "<td>" . $empleado->getID() . "</td>";
            echo "<td>" . $empleado->getNombreCompleto()  . "</td>";
            echo "<td>" . $empleado->getTelefono()  . "</td>";
            echo "<td>" . $empleado->getSucursal()  . "</td>";
            echo "</tr>";
        }?>
    </tbody>
  </table>
</div>