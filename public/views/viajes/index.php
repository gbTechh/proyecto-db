


	

	<main class="main-content">
		<section class="container top-trips">
			<h1 class="heading-1">Plan your next adventure</h1>
			<p class="parrafo">¿A dónde te gustaría ir?</p>

            <form id="search-form" class="date-inputs">
                <div>
                    <label for="origin-city">Origen:</label>
                    <select id="origin-city" name="origin-city">
                        <option value="">Seleccione una ciudad</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?= $ciudad->getNombre(); ?>"><?= $ciudad->getNombre(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="destination-city">Destino:</label>
                    <select id="destination-city" name="destination-city">
                        <option value="">Seleccione una ciudad</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?= $ciudad->getNombre(); ?>"><?= $ciudad->getNombre(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="start-date">Fecha de Inicio:</label>
                    <input type="date" id="start-date" name="start-date">
                </div>

                <div>
                    <label for="end-date">Fecha de Fin:</label>
                    <input type="date" id="end-date" name="end-date">
                </div>

               

                <div class="container confirm-trip">
                    <button type="submit" class="buscar-button">Buscar</button>
                </div>
            </form>

            <section >
                <div id="results">
                </div>
                <div class="container confirm-trip">
                    <a class= "buscar-button" href="<?php echo URLROOT . "/public/views/viajes/confirmar2.php"?>">Ver mi Selección</a>
                    <!--<button type="button" id="confirm-button" class="confirm-button">Confirmar</button>-->
                </div>

                <!-- Aquí aparecerán los vuelos -->
            </section>	

            

		</section>

	</main>
	
