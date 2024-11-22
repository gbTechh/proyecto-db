<div class="contenedor">
     <h2>Iniciar Sesión</h2>
        <form method="POST" class="login-form" action="login.php?action=post">
        <label for="email">Usuario:</label>
        <div class="contenedor-input">
            <input type="text" name="username" 
             value="<?= isset($data['old']['username']) ? $data['old']['username'] : ''; ?>">
        </div>
        <label for="password">Contraseña:</label>
        <div class="contenedor-input">
            <input type="password" name="password" value="<?= isset($data['old']['password']) ? $data['old']['password'] : ''; ?>">
        </div>
         <?php
        if(isset($data['errors']['login'])) { ?>
        <span class="text-error"><?= $data['errors']['login'] ?></span>
        <?php } ?>
        <button class="btn">Iniciar Sesión</button>
        </form>
</div>

