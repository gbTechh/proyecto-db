<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="hoteles">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary" href="hoteles.php?action=crear">
        Agregar hotel
    </a>
  </div>

  <!-- Lista de hoteles -->
  <div class="wrapp-hoteles">
     <table id="miTabla" class="display table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Categoría</th>
                <th>Teléfono</th>
                <th>Precio/Noche</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hoteles as $hotel): ?>
               <tr>
                    <td><?php echo $hotel->getNombre(); ?></td>
                    <td><?php echo $hotel->getDireccion(); ?></td>
                    <td><?php echo $hotel->getCategoria(); ?></td>
                    <td><?php echo $hotel->getTelefono(); ?></td>
                    <td><?php echo $hotel->getPrecioPorNoche(); ?></td>
                    <td><?php echo $hotel->getCiudad(); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="hoteles.php?action=editar&id=<?php echo $hotel->getId(); ?>" class="btn editar-btn">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="hoteles.php?action=eliminar&id=<?php echo $hotel->getId(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este hotel?');">
                                <i class="bx bx-trash"></i>
                            </a>
                        </div>
                    </td>
               </tr>
            <?php endforeach; ?>
        </tbody>
     </table>
  </div>
</div>
