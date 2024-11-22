
<div class="body-container">
  <div class="wrapp-body">
    <div class="wrapp-title">
      <h1 class="title"><?php echo $title; ?></h1>
      <a class="btn btn-primary" href="sucursales.php?action=crear">
      Agregar sucursal
      </a>

    </div>
    <!-- Contenido del Dashboard -->
    <div class="wrapp-sucursal">
      <table id="miTabla" class="display table">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Teléfono</th>
              <th>Dirección</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($sucursales as $sucursal) {
              echo "<tr>";
              echo "<td>" . $sucursal->getNombre()  . "</td>";
              echo "<td>" . $sucursal->getTelefono()  . "</td>";
              echo "<td>" . $sucursal->getDireccion()  . "</td>";
              echo "</tr>";
          }?>
      </tbody>
    </table>
  </div>
  </div>
 
</div>