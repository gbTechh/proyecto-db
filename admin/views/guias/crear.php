<div class="guias">
    <div class="wrapp-title">
        <h1 class="title">Crear Nuevo Guía</h1>
        <a href="guia_turistico.php" class="btn btn-secondary">
            Volver a la lista
        </a>
    </div>

    <div class="wrapp-guias">
        <form action="guia_turistico.php?action=post" method="POST" class="guias-form">
            
            <!-- Nombre del Guía -->
            <div class="form-group">
                <label for="nombre">Nombre del Guía *</label>
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
                <ul id="listaIdiomas" class="mt-3"></ul>
                <!-- Campo oculto para almacenar los idiomas concatenados -->
                <input type="hidden" id="idiomas" name="idiomas" value="<?php echo $old['idiomas'] ?? ''; ?>" />
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
                    value="<?php echo isset($old['telefono']) ? htmlspecialchars($old['telefono']) : ''; ?>"
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
                        <option value="<?php echo $ciudad->getId(); ?>" <?php echo isset($old['id_ciudad']) && $old['id_ciudad'] == $ciudad->getId() ? 'selected' : ''; ?>>
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
                <button type="submit" class="btn btn-primary">Guardar Guía Turístico</button>
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

        // Cargar idiomas previamente guardados
        const idiomasGuardados = idiomasInput.value ? idiomasInput.value.split(', ') : [];
        idiomasGuardados.forEach(function(idioma) {
            if (idioma) {
                agregarIdiomaALaLista(idioma);
            }
        });

        // Agregar idioma
        btnAgregarIdioma.addEventListener('click', function() {
            const idioma = nuevoIdioma.value.trim();
            if (idioma) {
                if (isIdiomaDuplicado(idioma)) {
                    alert('Este idioma ya ha sido agregado.');
                } else {
                    agregarIdiomaALaLista(idioma);
                    idiomasGuardados.push(idioma); // Agregar al array de idiomas
                    actualizarIdiomasInput(); // Actualizar el campo oculto
                    nuevoIdioma.value = ''; // Limpiar el campo de texto
                }
            }
        });

        // Eliminar idioma
        listaIdiomas.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-eliminar-idioma')) {
                const li = event.target.closest('li');
                const idioma = li.querySelector('span').textContent;
                idiomasGuardados.splice(idiomasGuardados.indexOf(idioma), 1); // Eliminar del array
                li.remove();
                actualizarIdiomasInput(); // Actualizar el campo oculto
            }
        });

        // Función para agregar un idioma a la lista
        function agregarIdiomaALaLista(idioma) {
            const li = document.createElement('li');
            li.innerHTML = `<span>${idioma}</span> <button type="button" class="btn-eliminar-idioma">Eliminar</button>`;
            listaIdiomas.appendChild(li);
        }

        // Función para actualizar el campo oculto con los idiomas
        function actualizarIdiomasInput() {
            idiomasInput.value = idiomasGuardados.join(', ');
        }

        // Función para comprobar si el idioma ya está en la lista
        function isIdiomaDuplicado(idioma) {
            return idiomasGuardados.some(existingIdioma => existingIdioma.toLowerCase() === idioma.toLowerCase());
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
