
<div class="sucursales">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary" href="sucursal/crear">
    Agregar sucursal
    </a>

  </div>
  <!-- Contenido del Dashboard -->
  <div class="wrapp-clientes">
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
        <?php foreach ($sucursales as $sucursal) {
           echo "<tr>";
            echo "<td>" . $sucursal->getID() . "</td>";
            echo "<td>" . $sucursal->getNombre()  . "</td>";
            echo "<td>" . $sucursal->getTelefono()  . "</td>";
            echo "<td>" . $sucursal->getDireccion()  . "</td>";
            echo "</tr>";
        }?>
    </tbody>
  </table>
  </div>
 
</div>