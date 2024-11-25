<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="body-container">
  <div class="wrapp-body">
    <div class="wrapp-title">
      <h1 class="title"><?php echo $title; ?></h1>
      <a class="btn btn-primary" href="transportes.php?action=crear">
          Agregar transporte
      </a>
    </div>

    <!-- Lista de transportes -->
    <div class="wrapp-transportes">
      <table id="miTabla" class="display table">
          <thead>
              <tr>
                  <th>Tipo</th>
                  <th>Costo</th>
                  <th>Empresa</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($transportes as $transporte): ?>
                <tr>
                      <td><?php echo $transporte->getTipo(); ?></td>
                      <td><?php echo $transporte->getCosto(); ?></td>
                      <td><?php echo $transporte->getEmpresa(); ?></td>
                      <td>
                          <div class="action-buttons">
                              <a href="transportes.php?action=edit&id=<?php echo $transporte->getID(); ?>" class="btn editar-btn">
                                  <i class="bx bx-edit"></i>
                              </a>
                              <a href="transportes.php?action=delete&id=<?php echo $transporte->getID(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este transporte?');">
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
</div>