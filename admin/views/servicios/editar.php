
<?php if (!empty($mensaje)): ?>
    <div class="alert alert-success">
        <?= $mensaje ?>
    </div>
<?php endif; ?>
<div class="servicios">
    <div class="wrapp-title">
        <h1 class="title">Editar Servicio</h1>
        <a href="servicios.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-servicios">
        <form action="servicios.php?action=update&id=<?php echo $servicio->getID(); ?>" method="POST" class="servicio-form">
            
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción *</label>
                <textarea 
                    id="descripcion" 
                    name="descripcion" 
                    class="form-control <?php echo isset($errors['descripcion']) ? 'is-invalid' : ''; ?>"
                    required
                ><?php echo htmlspecialchars($servicio->getDescripcion()); ?></textarea>
                <?php if (isset($errors['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['descripcion']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Costo -->
            <div class="form-group">
                <label for="costo">Costo *</label>
                <input 
                    type="number" 
                    id="costo" 
                    name="costo" 
                    value="<?php  htmlspecialchars($data['servicio']->getCosto()); ?>"
                    class="form-control <?php echo isset($errors['costo']) ? 'is-invalid' : ''; ?>"
                    required
                >
                <?php if (isset($errors['costo'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['costo']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ciudad -->
            <div class="form-group">
                <label for="id_ciudad">Ciudad *</label>
                <select 
                    id="id_ciudad" 
                    name="id_ciudad" 
                    class="form-control <?php echo isset($errors['id_ciudad']) ? 'is-invalid' : ''; ?>"
                    required
                >
                    <option value="">Seleccione una ciudad</option>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo $ciudad->getID(); ?>" <?php 
                            echo $servicio->getCiudad() == $ciudad->getID() ? 'selected' : ''; 
                        ?>>
                            <?php echo $ciudad->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_ciudad'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_ciudad']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Proveedor del Hotel -->
            <div class="form-group">
                <label for="id_proveedor">Proveedor(es) *</label>
                <select 
                    id="id_proveedor" 
                    name="id_proveedor[]" 
                    class="form-control <?php echo isset($errors['id_proveedor']) ? 'is-invalid' : ''; ?>"
                    required
                    multiple
                >
                    <option value="">Seleccione un proveedor(es)</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?php echo $proveedor->getID(); ?>" <?php 
                            echo $servicio->getProveedor() == $proveedor->getID() ? 'selected' : ''; 
                        ?>>
                            <?php echo $proveedor->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_proveedor'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_proveedor']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botón Actualizar -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Servicio</button>
            </div>
        </form>
    </div>
</div>