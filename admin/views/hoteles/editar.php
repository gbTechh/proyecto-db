<div class="hoteles">
    <div class="wrapp-title">
        <h1 class="title">Editar Hotel</h1>
        <a href="hoteles.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-hoteles">
        <form action="hoteles.php?action=update&id=<?php echo $hotel->getID(); ?>" method="POST" class="hotel-form">
            
            <!-- Nombre del Hotel -->
            <div class="form-group">
                <label for="nombre">Nombre del Hotel *</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['nombre']) ? htmlspecialchars($old['nombre']) : htmlspecialchars($hotel->getNombre()); ?>"
                    required
                >
                <?php if (isset($errors['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Dirección del Hotel -->
            <div class="form-group">
                <label for="direccion">Dirección *</label>
                <input 
                    type="text" 
                    id="direccion" 
                    name="direccion" 
                    class="form-control <?php echo isset($errors['direccion']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['direccion']) ? htmlspecialchars($old['direccion']) : htmlspecialchars($hotel->getDireccion()); ?>"
                    required
                >
                <?php if (isset($errors['direccion'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['direccion']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Categoría del Hotel -->
            <div class="form-group">
                <label for="categoria">Categoría *</label>
                <select 
                    id="categoria" 
                    name="categoria" 
                    class="form-control <?php echo isset($errors['categoria']) ? 'is-invalid' : ''; ?>"
                    required
                >
                    <option value="">Seleccione una categoría</option>
                    <option value="1 estrella" <?php echo isset($old['categoria']) && $old['categoria'] == '1 estrella' ? 'selected' : ($hotel->getCategoria() == '1 estrella' ? 'selected' : ''); ?>>1 estrella</option>
                    <option value="2 estrellas" <?php echo isset($old['categoria']) && $old['categoria'] == '2 estrellas' ? 'selected' : ($hotel->getCategoria() == '2 estrellas' ? 'selected' : ''); ?>>2 estrellas</option>
                    <option value="3 estrellas" <?php echo isset($old['categoria']) && $old['categoria'] == '3 estrellas' ? 'selected' : ($hotel->getCategoria() == '3 estrellas' ? 'selected' : ''); ?>>3 estrellas</option>
                    <option value="4 estrellas" <?php echo isset($old['categoria']) && $old['categoria'] == '4 estrellas' ? 'selected' : ($hotel->getCategoria() == '4 estrellas' ? 'selected' : ''); ?>>4 estrellas</option>
                    <option value="5 estrellas" <?php echo isset($old['categoria']) && $old['categoria'] == '5 estrellas' ? 'selected' : ($hotel->getCategoria() == '5 estrellas' ? 'selected' : ''); ?>>5 estrellas</option>
                </select>
                <?php if (isset($errors['categoria'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['categoria']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Teléfono del Hotel -->
            <div class="form-group">
                <label for="telefono">Teléfono *</label>
                <input 
                    type="tel" 
                    id="telefono" 
                    name="telefono" 
                    class="form-control <?php echo isset($errors['telefono']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['telefono']) ? htmlspecialchars($old['telefono']) : htmlspecialchars($hotel->getTelefono()); ?>"
                    required
                >
                <?php if (isset($errors['telefono'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['telefono']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Precio por Noche -->
            <div class="form-group">
                <label for="precio_por_noche">Precio por Noche *</label>
                <input 
                    type="number" 
                    id="precio_por_noche" 
                    name="precio_por_noche" 
                    class="form-control <?php echo isset($errors['precio_por_noche']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['precio_por_noche']) ? htmlspecialchars($old['precio_por_noche']) : htmlspecialchars($hotel->getPrecioPorNoche()); ?>"
                    required
                    step="0.01"
                >
                <?php if (isset($errors['precio_por_noche'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['precio_por_noche']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ciudad del Hotel -->
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
                        <option value="<?php echo $ciudad->getId(); ?>" <?php echo isset($old['id_ciudad']) && $old['id_ciudad'] == $ciudad->getId() ? 'selected' : ($hotel->getCiudad() == $ciudad->getId() ? 'selected' : ''); ?>>
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
                    <?php 
                    // Si hay datos antiguos de POST, usa esos
                    $selectedProveedores = isset($old['id_proveedor']) ? $old['id_proveedor'] : 
                        // Si no, usa los proveedores asociados originales
                        array_map(fn($p) => $p->getID(), $proveedoresAsociados);
                    
                    foreach ($proveedores as $proveedor): ?>
                        <option value="<?php echo $proveedor->getID(); ?>"
                            <?php echo in_array($proveedor->getID(), $selectedProveedores) ? 'selected' : ''; ?>>
                            <?php echo $proveedor->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_proveedor'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_proveedor']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botones de acción -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Hotel</button>
            </div>
        </form>
    </div>
</div>
