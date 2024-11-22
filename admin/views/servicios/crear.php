<div class="servicios">
    <div class="wrapp-title">
        <h1 class="title">Crear Servicio</h1>
        <a href="servicios.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-servicio">
        <form action="servicios.php?action=guardar" method="POST" class="servicio-form">
            
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción del Servicio *</label>
                <textarea 
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
                    required
                >
                <?php if (isset($errors['costo'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['costo']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ciudad -->
            <div class="form-group">
                <label for="ciudad_int">Ciudad *</label>
                <select 
                    id="ciudad_int" 
                    name="ciudad_int" 
                    class="form-control <?php echo isset($errors['ciudad_int']) ? 'is-invalid' : ''; ?>"
                    required
                >
                    <option value="">Seleccione una ciudad</option>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?php echo $ciudad->getID(); ?>" <?php 
                            echo isset($old['ciudad_int']) && $old['ciudad_int'] == $ciudad->getID() ? 'selected' : ''; 
                        ?>>
                            <?php echo $ciudad->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['ciudad_int'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['ciudad_int']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Proveedor -->
            <div class="form-group">
                <label for="id_proveedor">Proveedor *</label>
                <input 
                    type="text" 
                    id="id_proveedor" 
                    name="id_proveedor" 
                    class="form-control <?php echo isset($errors['id_proveedor']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['id_proveedor']) ? htmlspecialchars($old['id_proveedor']) : ''; ?>"
                    required
                >
                <?php if (isset($errors['id_proveedor'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_proveedor']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botón Guardar -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Crear Servicio</button>
            </div>
        </form>
    </div>
</div>