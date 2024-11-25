<div class="hoteles">
    <div class="wrapp-title">
        <h1 class="title"><?php echo htmlspecialchars($hotel->getNombre()); ?></h1>
        <a href="hoteles.php" class="btn btn-secondary">Volver a la lista</a>
    </div>

    <div class="wrapp-hoteles">
        <div class="hotel-info-section">
            <h2 class="section-title">Información del Hotel</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($hotel->getNombre()); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($hotel->getDireccion()); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($hotel->getCategoria()); ?></p>
            <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($hotel->getTelefono()); ?></p>
            <p><strong>Precio por noche:</strong> <?php echo number_format($hotel->getPrecioPorNoche(), 2); ?> USD</p>
            <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($ciudad->getNombre()); ?></p>
            <img class="show-img" src="<?= URLROOT . "/uploads/" . $hotel->getImagen();?>">
        </div>

        <div class="proveedores-section">
            <h2 class="section-title">Proveedores del Hotel</h2>
            <div class="proveedores-grid">
                <?php foreach ($proveedoresAsociados as $proveedor): ?>
                    <div class="proveedor-card">
                        <h3><?php echo htmlspecialchars($proveedor->getNombre()); ?></h3>
                        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($proveedor->getDireccion()); ?></p>
                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($proveedor->getTelefono()); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($proveedor->getEmail()); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
