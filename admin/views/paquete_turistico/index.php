<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>

<div class="paquete_turistico">
    <div class="wrapp-title">
        <h1 class="title">Gestión de Paquetes Turísticos</h1>
        <a href="paquete_turistico.php?action=crear" class="btn btn-primary">
            Agregar Paquete Turístico
        </a>
    </div>

    <div class="wrapp-paquete">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paquetes as $paquete): ?>
                    <tr>
                        <td><?php echo $paquete->getNombre(); ?></td>
                        <td><?php echo $paquete->getDescripcion(); ?></td>
                        <td><?php echo $paquete->getPrecio(); ?></td>
                        <td><?php echo $paquete->getCiudad(); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="paquete_turistico.php?action=editar&id=<?php echo $paquete->getID(); ?>" class="btn editar-btn">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <a href="paquete_turistico.php?action=eliminar&id=<?php echo $paquete->getID(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este paquete?');">
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