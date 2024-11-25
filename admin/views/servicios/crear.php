<div class="servicios">
    <div class="wrapp-title">
        <h1 class="title">Crear Servicio</h1>
        <a href="servicios.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-servicios">
        <form action="servicios.php?action=post" method="POST" class="servicio-form">
           <!-- Proveedor -->
           <div class="form-group">
                <label for="id_proveedor">Proveedores *</label>
                <select 
                    id="id_proveedor" 
                    name="id_proveedor" 
                    class="form-control <?php echo isset($errors['id_proveedor']) ? 'is-invalid' : ''; ?>" 
                    required
                >
                    <option value="" disabled selected>Seleccione un proveedor</option>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <option value="<?php echo $proveedor->getID(); ?>" 
                            <?php echo isset($old['id_proveedor']) && $old['id_proveedor'] == $proveedor->getID() ? 'selected' : ''; ?>>
                            <?php echo $proveedor->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_proveedor'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_proveedor']; ?></div>
                <?php endif; ?>
            </div>
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción del Servicio *</label>
                <input
                    type="text" 
                    id="descripcion" 
                    name="descripcion" 
                    class="form-control <?php echo isset($errors['descripcion']) ? 'is-invalid' : ''; ?>" 
                    required
                ><?php echo isset($old['descripcion']) ? htmlspecialchars($old['descripcion']) : ''; ?></textarea>
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
                    class="form-control <?php echo isset($errors['costo']) ? 'is-invalid' : ''; ?>" 
                    value="<?php echo isset($old['costo']) ? htmlspecialchars($old['costo']) : ''; ?>" 
                    min="0" 
                    max="10000" 
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
                    <option value="" disabled selected>Seleccione una ciudad</option>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo $ciudad->getID(); ?>" 
                            <?php echo isset($old['id_ciudad']) && $old['id_ciudad'] == $ciudad->getID() ? 'selected' : ''; ?>>
                            <?php echo $ciudad->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_ciudad'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_ciudad']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botón Guardar -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>