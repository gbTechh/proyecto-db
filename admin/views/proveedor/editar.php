<div class="proveedor">
    <div class="wrapp-title">
        <h1 class="title">Editar Proveedor</h1>
        <a href="proveedor.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-proveedor">
        <form action="proveedor.php?action=actualizar&id=<?php echo $proveedor->getID(); ?>" method="POST" class="proveedor-form">
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre del Proveedor *</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($proveedor->getNombre()); ?>"
                    required
                >
                <?php if (isset($errors['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Dirección -->
            <div class="form-group">
                <label for="direccion">Dirección *</label>
                <input 
                    type="text" 
                    id="direccion" 
                    name="direccion" 
                    class="form-control <?php echo isset($errors['direccion']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($proveedor->getDireccion()); ?>"
                    required
                >
                <?php if (isset($errors['direccion'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['direccion']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono *</label>
                <input 
                    type="text" 
                    id="telefono" 
                    name="telefono" 
                    class="form-control <?php echo isset($errors['telefono']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($proveedor->getTelefono()); ?>"
                    required
                >
                <?php if (isset($errors['telefono'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['telefono']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($proveedor->getEmail()); ?>"
                    required
                >
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botón Actualizar -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
            </div>
        </form>
    </div>
</div>