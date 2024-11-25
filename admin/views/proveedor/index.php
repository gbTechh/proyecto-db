<div class="proveedores">
    <div class="wrapp-title">
        <h1 class="title">Gestión de Proveedores</h1>
        <a href="proveedor.php?action=crear" class="btn btn-primary">
            Agregar Proveedor
        </a>
    </div>

    <div class="wrapp-proveedor">
        <table id="miTabla" class="display table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedores as $proveedor): ?>
                    <tr>
                        <td><?php echo $proveedor->getNombre(); ?></td>
                        <td><?php echo $proveedor->getDireccion(); ?></td>
                        <td><?php echo $proveedor->getTelefono(); ?></td>
                        <td><?php echo $proveedor->getEmail(); ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="proveedor.php?action=editar&id=<?php echo $proveedor->getID(); ?>" class="btn editar-btn">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <a href="proveedor.php?action=eliminar&id=<?php echo $proveedor->getID(); ?>" class="btn eliminar-btn" onclick="return confirm('¿Estás seguro de eliminar este proveedor?');">
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