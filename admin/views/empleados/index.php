<?php 

$rol = $_SESSION['empleado']['rol'];
?>

<div class="body-container">
  <div class="wrapp-body">
     <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <?php if($rol === "Gerente" || $rol === "Administrador"){?>
    <a class="btn btn-primary" href="empleados.php?action=crear">
    Agregar empleado
    </a>
    <?php }?>

  </div>
  <!-- Contenido del Dashboard -->
  <div class="form">
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
 
  </div>
 
</div>