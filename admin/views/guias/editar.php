<div class="hoteles">
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
            
            <!-- Idiomas del Guía -->
            <div class="form-group">
                <label for="idiomas">Idiomas *</label>
                <div id="idiomas-container">
                    <input 
                        type="text" 
                        id="nuevoIdioma" 
                        class="form-control" 
                        placeholder="Escribe un idioma y haz clic en 'Agregar'" 
                    />
                    <button type="button" id="btnAgregarIdioma" class="btn btn-primary mt-2">Agregar Idioma</button>
                </div>
                <ul id="listaIdiomas" class="mt-3">
                    <?php 
                    // Mostrar idiomas existentes o de POST
                    $idiomasIniciales = isset($old['idiomas']) ? $old['idiomas'] : $guia->getIdiomas();
                    $idiomasArray = explode(', ', $idiomasIniciales);
                    foreach ($idiomasArray as $idioma):
                        if (!empty(trim($idioma))): ?>
                            <li>
                                <span><?php echo htmlspecialchars($idioma); ?></span>
                                <button type="button" class="btn-eliminar-idioma">Eliminar</button>
                            </li>
                    <?php 
                        endif; 
                    endforeach; 
                    ?>
                </ul>
                <input type="hidden" id="idiomas" name="idiomas" value="<?php echo htmlspecialchars($idiomasIniciales); ?>" />
                <?php if (isset($errors['idiomas'])): ?>
                    <div class="invalid-feedback"><?= $errors['idiomas'] ?></div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnAgregarIdioma = document.getElementById('btnAgregarIdioma');
        const nuevoIdioma = document.getElementById('nuevoIdioma');
        const listaIdiomas = document.getElementById('listaIdiomas');
        const idiomasInput = document.getElementById('idiomas');

        //Agregar idioma
        btnAgregarIdioma.addEventListener('click', function() {
            const idioma = nuevoIdioma.value.trim();
            if (idioma) {
                if (isIdiomaDuplicado(idioma)) {
                    alert('Este idioma ya ha sido agregado.');
                } else {
                    const li = document.createElement('li');
                    li.innerHTML = `<span>${idioma}</span> <button type="button" class="btn-eliminar-idioma">Eliminar</button>`;
                    listaIdiomas.appendChild(li);
                    actualizarIdiomasInput();
                    nuevoIdioma.value = '';
                }
            }
        });

        //Eliminar idioma
        listaIdiomas.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-eliminar-idioma')) {
                event.target.closest('li').remove();
                actualizarIdiomasInput();
            }
        });

        // Actualizar el campo de idiomas
        function actualizarIdiomasInput() {
            const idiomas = [];
            const listaItems = listaIdiomas.querySelectorAll('li');
            listaItems.forEach(function(item) {
                idiomas.push(item.querySelector('span').textContent);
            });
            idiomasInput.value = idiomas.join(', ');
        }

        // Comprobar si el idioma ya está en la lista
        function isIdiomaDuplicado(idioma) {
            const listaItems = listaIdiomas.querySelectorAll('li span');
            return Array.from(listaItems).some(item => item.textContent.toLowerCase() === idioma.toLowerCase());
        }
        
        // Prevenir el envío del formulario al presionar Enter en el campo de agregar idioma
        nuevoIdioma.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Previene el envío del formulario
                btnAgregarIdioma.click(); // Llama al mismo evento de agregar idioma
            }
        });

    });
</script>
