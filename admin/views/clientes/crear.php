
<div class="body-container">
    <div class="wrapp-body">
        <form method="POST" class="cliente-form" action="clientes.php?action=post">
            <div class="wrapp-title">
            <h1 class="title">Crear un nuevo cliente</h1>
            <button type="submit" class="btn btn-primary">Guardar Cliente</button>

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
            <div class="wrapp-clientes">
            <div class="form-group">
                    <label for="dni">DNI *</label>
                    <input type="text" 
                        id="dni" 
                        name="dni" 
                        value="<?php echo isset($old['dni']) ? htmlspecialchars($old['dni']) : ''; ?>"
                        class="form-control <?php echo isset($errors['dni']) ? 'is-invalid' : ''; ?>"
                        required>
                    <?php if (isset($errors['dni'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['dni']; ?></div>
                    <?php endif; ?>
                </div>
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
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" 
                        id="apellidos" 
                        name="apellidos" 
                        value="<?php echo isset($old['apellidos']) ? htmlspecialchars($old['apellidos']) : ''; ?>"
                        class="form-control <?php echo isset($errors['apellidos']) ? 'is-invalid' : ''; ?>"
                        required>
                    <?php if (isset($errors['apellidos'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['apellidos']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo isset($old['email']) ? htmlspecialchars($old['email']) : ''; ?>"
                        class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                        required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
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
                    <label for="username">Nombre de usuario</label>
                    <input type="text" 
                        id="username" 
                        name="username" 
                        value="<?php echo isset($old['username']) ? htmlspecialchars($old['username']) : ''; ?>"
                        class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>">
                    <?php if (isset($errors['username'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['username']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" 
                        id="password" 
                        name="password" 
                        value="<?php echo isset($old['password']) ? htmlspecialchars($old['password']) : ''; ?>"
                        class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>">
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>
                </div>

            
            </div>
        </form>
    </div>
 
  
 
</div>