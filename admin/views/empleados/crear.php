<?php 
$rol = $_SESSION['empleado']['rol'];
$id_sucursal = $_SESSION['empleado']['id_sucursal'];

?>
<div class="body-container">
  <div class="wrapp-body">   
    <form action="empleados.php?action=post" method="POST" class="">
      <div class="wrapp-title">
        <div class="div-title">
          <a href="<?= URLROOT. "/admin/empleados.php"?>">
            <i class='bx bx-arrow-back'></i>
          </a>
          <h1>Crear nuevo empleado</h1>
        </div>
        <div class="">
            <button type="submit" class="btn btn-primary">Guardar empleado</button>
        </div>
      </div>
      <div class="form">
        <!-- DNI -->
          <div class="form-group">
              <label for="dni">Dni *</label>
              <input 
                  type="text" 
                  id="dni" 
                  name="dni" 
                  class="form-control <?php echo isset($errors['dni']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['dni']) ? htmlspecialchars($old['dni']) : ''; ?>"
                  required
              >
              <?php if (isset($errors['dni'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['dni']; ?></div>
              <?php endif; ?>
          </div>

          <!-- Nombre -->
          <div class="form-group">
              <label for="nombre">Nombre *</label>
              <input 
                  type="text" 
                  id="nombre" 
                  name="nombre" 
                  class="form-control <?php echo isset($errors['nombre']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['nombre']) ? htmlspecialchars($old['nombre']) : ''; ?>"
                  required
              >
              <?php if (isset($errors['nombre'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['nombre']; ?></div>
              <?php endif; ?>
          </div>
          <!-- Apellidos -->
          <div class="form-group">
              <label for="apellidos">Apellidos *</label>
              <input 
                  type="text" 
                  id="apellidos" 
                  name="apellidos" 
                  class="form-control <?php echo isset($errors['apellidos']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['apellidos']) ? htmlspecialchars($old['apellidos']) : ''; ?>"
                  required
              >
              <?php if (isset($errors['apellidos'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['apellidos']; ?></div>
              <?php endif; ?>
          </div>
           <!-- Teléfono  -->
          <div class="form-group">
              <label for="telefono">Teléfono *</label>
              <input 
                  type="tel" 
                  id="telefono" 
                  name="telefono" 
                  class="form-control <?php echo isset($errors['telefono']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['telefono']) ? htmlspecialchars($old['telefono']) : ''; ?>"
                  required
              >
              <?php if (isset($errors['telefono'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['telefono']; ?></div>
              <?php endif; ?>
          </div>

          <!-- SUCURSALES del Hotel -->
          <div class="form-group">
              <label for="sucursal">Sucursal *</label>
              <select 
                  <?= $rol == 'Administrador' ? '' : 'disabled' ?>
                  id="sucursal" 
                  name="sucursal" 
                  class="form-control <?php echo isset($errors['sucursal']) ? 'is-invalid' : ''; ?>"
                  required
              >
                  <option value="">Seleccione un sucursal</option>
                  <?php foreach ($sucursales as $sucursal) { ?>
                    <option  <?= $rol == 'Gerente' && $sucursal->getID() == $id_sucursal ? 'selected' : '' ?> value="<?= $sucursal->getID()?>" <?php echo isset($old['sucursal']) && $old['sucursal'] == $sucursal->getID() ? 'selected' : ''; ?>><?= $sucursal->getNombre();?></option>
                  <?php }?>
                 
              </select>
              <?php if (isset($errors['sucursal'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['sucursal']; ?></div>
              <?php endif; ?>
          </div>
          <!-- Puestos del Hotel -->
          <div class="form-group">
              <label for="puesto">Puesto *</label>
              <select                  
                  id="puesto" 
                  name="puesto" 
                  class="form-control <?php echo isset($errors['puesto']) ? 'is-invalid' : ''; ?>"
                  required
              >
                  <option value="">Seleccione un puesto</option>
                  <?php if ($rol == "Administrador"): ?>
                    <option  value="Administrador" <?php echo isset($old['puesto']) && $old['puesto'] == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                  <?php endif; ?>
                  <option  value="Vendedor" <?php echo isset($old['puesto']) && $old['puesto'] == 'Vendedor' ? 'selected' : ''; ?>>Vendedor</option>
                  <option  value="Gerente" <?php echo isset($old['puesto']) && $old['puesto'] == 'Gerente' ? 'selected' : ''; ?>>Gerente</option>
              </select>
              <?php if (isset($errors['puesto'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['puesto']; ?></div>
              <?php endif; ?>
          </div>

         

          <!-- Username -->
          <div class="form-group">
              <label for="e_username">Nombre de usuario *</label>
              <input 
                  type="text" 
                  id="e_username" 
                  name="e_username" 
                  class="form-control <?php echo isset($errors['e_username']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['e_username']) ? htmlspecialchars($old['e_username']) : ''; ?>"
                  required
                  step="0.01"
              >
              <?php if (isset($errors['e_username'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['e_username']; ?></div>
              <?php endif; ?>
          </div>
          <!-- Password -->
          <div class="form-group">
              <label for="e_password">Contraseña *</label>
              <input 
                  type="text" 
                  id="e_password" 
                  name="e_password" 
                  class="form-control <?php echo isset($errors['e_password']) ? 'is-invalid' : ''; ?>"
                  value="<?php echo isset($old['e_password']) ? htmlspecialchars($old['e_password']) : ''; ?>"
                  required
                  step="0.01"
              >
              <?php if (isset($errors['e_password'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['e_password']; ?></div>
              <?php endif; ?>
          </div>

         
      </div>
        
    </form>

 
  </div>
       
</div>