<div class="paquete_turistico">
    <div class="wrapp-title">
        <h1 class="title">Editar Paquete Turístico</h1>
        <a href="paquete_turistico.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-paquete">
        <form action="paquete_turistico.php?action=actualizar&id=<?php echo $paquete->getID(); ?>" method="POST" class="paquete-form">
            
            <!-- Nombre -->
            <div class="form-group">
                <label for="nombre">Nombre del Paquete *</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($paquete->getNombre()); ?>"
                    required
                >
                <?php if (isset($errors['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción *</label>
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    class="form-control <?php echo isset($errors['descripcion']) ? 'is-invalid' : ''; ?>"
                    required
                ><?php echo htmlspecialchars($paquete->getDescripcion()); ?></textarea>
                <?php if (isset($errors['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['descripcion']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio *</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    class="form-control <?php echo isset($errors['precio']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($paquete->getPrecio()); ?>"
                    required
                >
                <?php if (isset($errors['precio'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['precio']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ciudad -->
            <div class="form-group">
                <label for="ciudad">Ciudad *</label>
                <select 
                    id="ciudad" 
                    name="ciudad" 
                    class="form-control <?php echo isset($errors['ciudad']) ? 'is-invalid' : ''; ?>"
                    required
                >
                    <option value="">Seleccione una ciudad</option>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo $ciudad->getId(); ?>" <?php 
                            echo $paquete->getCiudad() == $ciudad->getId() ? 'selected' : ''; 
                        ?>>
                            <?php echo $ciudad->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['ciudad'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['ciudad']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botón Actualizar -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Paquete</button>
            </div>
        </form>
    </div>
</div>