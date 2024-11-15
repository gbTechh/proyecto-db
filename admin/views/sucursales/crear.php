
<div class="sucursal">
  <form method="POST" class="sucursal-form" action="sucursales.php?action=post">
    <div class="wrapp-title">
      <h1 class="title"><?php echo $title; ?></h1>
      <button type="submit" class="btn btn-primary">Guardar Sucursal</button>

    </div>

    <?php if (!empty($errors) && is_array($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <!-- Contenido del Dashboard -->
    <div class="wrapp-sucursal">
      <div class="form-group">
            <label for="nombre">Nombre *</label>
            <input type="text" 
                   id="nombre" 
                   name="nombre" 
                   value="<?php echo isset($old['nombre']) ? htmlspecialchars($old['nombre']) : ''; ?>"
                   class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                   required>
            <?php if (isset($errors['nombre'])): ?>
                <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
            <?php endif; ?>
      </div>

        <div class="form-group">
            <label for="telefono">Teléfono *</label>
            <input type="tel" 
                   id="telefono" 
                   name="telefono" 
                   value="<?php echo isset($old['telefono']) ? htmlspecialchars($old['telefono']) : ''; ?>"
                   class="form-control <?php echo isset($errors['telefono']) ? 'is-invalid' : ''; ?>">
            <?php if (isset($errors['telefono'])): ?>
                <div class="invalid-feedback"><?php echo $errors['telefono']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección *</label>
            <input type="text" 
                   id="direccion" 
                   name="direccion" 
                   value="<?php echo isset($old['direccion']) ? htmlspecialchars($old['direccion']) : ''; ?>"
                   class="form-control <?php echo isset($errors['direccion']) ? 'is-invalid' : ''; ?>">
            <?php if (isset($errors['direccion'])): ?>
                <div class="invalid-feedback"><?php echo $errors['direccion']; ?></div>
            <?php endif; ?>
        </div>
     
    </div>
  </form>
  
 
</div>