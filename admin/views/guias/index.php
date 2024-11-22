<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="guias">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary" href="guia_turistico.php?action=crear">
        Agregar Guía Turístico
    </a>
  </div>

  <!-- Lista de hoteles -->
  <div class="wrapp-guia">
     <table id="miTabla" class="display table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Idioma</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guias as $guia): ?>
               <tr>
                    <td><?php echo $guia->getNombre(); ?></td>
                    <td><?php echo $guia->getTelefono(); ?></td>
                    <td><?php echo $guia->getIdioma(); ?></td>
                    <td><?php echo $guia->getCiudad(); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="guia_turistico.php?action=editar&id=<?php echo $guia->getID(); ?>" class="btn editar-btn">
                                <i class="bx bx-edit"></i>
                            </a>
                            <a href="guia_turistico.php?action=eliminar&id=<?php echo $guia->getID(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este hotel?');">
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
