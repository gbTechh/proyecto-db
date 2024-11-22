<div class="guias">
    <div class="wrapp-title">
        <h1 class="title">Editar Guía Turístico</h1>
        <a href="guia_turistico.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-guias">
        <form action="guia_turistico.php?action=update&id=<?php echo $guia->getID(); ?>" method="POST" class="guias-form">
            
            <!-- Nombre del Guía -->
            <div class="form-group">
                <label for="nombre">Nombre del Guía *</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['nombre']) ? htmlspecialchars($old['nombre']) : htmlspecialchars($guia->getNombre()); ?>"
                    required
                >
                <?php if (isset($errors['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
                <?php endif; ?>
            </div>
            
            <!-- Idioma principal del Guía -->
            <div class="form-group">
                <label for="nombre">Idioma *</label>
                <input 
                    type="text" 
                    id="idioma" 
                    name="idioma" 
                    class="form-control <?php echo isset($errors['idioma']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['idioma']) ? htmlspecialchars($old['idioma']) : htmlspecialchars($guia->getIdioma()); ?>"
                    required
                >
                <?php if (isset($errors['idioma'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['idioma']; ?></div>
                <?php endif; ?>
            </div>
            <!-- Teléfono del Guía -->
            <div class="form-group">
                <label for="telefono">Teléfono *</label>
                <input 
                    type="tel" 
                    id="telefono" 
                    name="telefono" 
                    class="form-control <?php echo isset($errors['telefono']) ? 'is-invalid' : ''; ?>"
                    value="<?php echo isset($old['telefono']) ? htmlspecialchars($old['telefono']) : htmlspecialchars($guia->getTelefono()); ?>"
                    required
                >
                <?php if (isset($errors['telefono'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['telefono']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Ciudad del Guía -->
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
                        <option value="<?php echo $ciudad->getId(); ?>" <?php 
                            echo (isset($old['id_ciudad']) && $old['id_ciudad'] == $ciudad->getId()) || 
                                 (!isset($old['id_ciudad']) && $guia->getCiudad() == $ciudad->getId()) ? 'selected' : ''; 
                        ?>>
                            <?php echo $ciudad->getNombre(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_ciudad'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['id_ciudad']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Botones de acción -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Guía Turístico</button>
            </div>
        </form>
    </div>
</div>
