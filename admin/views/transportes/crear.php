<div class="body-container">
    <div class="wrapp-body">
      <div class="wrapp-title">
        <h1 class="title">Crear Nuevo Transporte</h1>
        <a href="transportes.php" class="btn btn-secondary">
            Volver a la lista
        </a>
      </div>

      <div class="wrapp-transportes">
          <form action="transportes.php?action=post" method="POST" class="transporte-form">
              

              <!-- Tipo de Transporte -->
              <div class="form-group">
                  <label for="tipo">Tipo de Transporte *</label>
                  <input 
                      type="text" 
                      id="tipo" 
                      name="tipo" 
                      class="form-control <?php echo isset($errors['tipo']) ? 'is-invalid' : ''; ?>"
                      value="<?php echo isset($old['tipo']) ? htmlspecialchars($old['tipo']) : ''; ?>"
                      required
                  >
                  <?php if (isset($errors['tipo'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['tipo']; ?></div>
                  <?php endif; ?>
              </div>

              <!-- Costo del Transporte -->
              <div class="form-group">
                  <label for="costo">Costo *</label>
                  <input 
                      type="number" 
                      id="costo" 
                      name="costo" 
                      class="form-control <?php echo isset($errors['costo']) ? 'is-invalid' : ''; ?>"
                      value="<?php echo isset($old['costo']) ? htmlspecialchars($old['costo']) : ''; ?>"
                      required
                      step="0.01"
                  >
                  <?php if (isset($errors['costo'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['costo']; ?></div>
                  <?php endif; ?>
              </div>

              <!-- Empresa del Transporte -->
              <div class="form-group">
                  <label for="empresa">Empresa *</label>
                  <input 
                      type="text" 
                      id="empresa" 
                      name="empresa" 
                      class="form-control <?php echo isset($errors['empresa']) ? 'is-invalid' : ''; ?>"
                      value="<?php echo isset($old['empresa']) ? htmlspecialchars($old['empresa']) : ''; ?>"
                      required
                  >
                  <?php if (isset($errors['empresa'])): ?>
                      <div class="invalid-feedback"><?php echo $errors['empresa']; ?></div>
                  <?php endif; ?>
              </div>



              <!-- Botones de acción -->
              <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary">Guardar Transporte</button>
              </div>
          </form>
      </div>

    </div>
</div>