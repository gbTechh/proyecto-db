<?php 
require_once ROOT . '/app/views/templates/TableHelper.php';

?>

<div class="dashboard">
  <h1><?php echo $title; ?></h1>
  <!-- Contenido del Dashboard -->
  <table id="miTabla" class="display table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clientes as $cliente) {
           echo "<tr>";
            echo "<td>" . $cliente->getID() . "</td>";
            echo "<td>" . $cliente->getNombreCompleto()  . "</td>";
            echo "<td>" . $cliente->getTelefono()  . "</td>";
            echo "<td>" . $cliente->getEmail()  . "</td>";
            echo "</tr>";
        }?>
    </tbody>
  </table>
</div>