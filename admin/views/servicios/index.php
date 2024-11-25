

<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="body-container">
    <div class="wrapp-body">
         <div class="wrapp-title">
            <h1 class="title">Gestión de Servicios</h1>
            <a href="servicios.php?action=crear" class="btn btn-primary">
                Agregar Servicios
            </a>
        </div>

        <div class="wrapp-servicios">
            <table class="table">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Proveedores</th>
                        <th>Precio</th>
                        <th>Ciudad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicios as $servicio): ?>
                        <tr>
                            <td><?php echo $servicio->getDescripcion(); ?></td>
                            <td><?php echo $servicio->getProveedor(); ?></td>
                            <td><?php echo $servicio->getCosto(); ?></td>
                            <td><?php echo $servicio->getCiudad(); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="servicios.php?action=editar&id=<?php echo $servicio->getID(); ?>" class="btn editar-btn">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <a href="servicios.php?action=eliminar&id=<?php echo $servicio->getID(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este paquete?');">
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