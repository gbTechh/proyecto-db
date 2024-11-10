
<div class="clientes">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary">
    Agregar cliente
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
 
</div>