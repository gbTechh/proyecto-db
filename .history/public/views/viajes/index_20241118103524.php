<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0"
	/>
	<title>Around the world</title>
	<link rel="stylesheet" href="style2.css" />
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
	<main class="main-content">
		<section class="container top-trips">
			<h1 class="heading-1">Plan your next adventure</h1>
			<p class="parrafo">¿A dónde te gustaría ir??</p>

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

                <div>
                    <label for="num-people">Número de Personas:</label>
                    <div class="num-people-input">
                        <button type="button" onclick="decrementPeople()">-</button>
                        <input type="number" id="num-people" name="num-people" min="1" value="1" readonly>
                        <button type="button" onclick="incrementPeople()">+</button>
                    </div>
                </div>

                <div class="container confirm-trip">
                    <button type="submit" class="buscar-button">Buscar</button>
                </div>
            </form>

            <section>
                <div id="results">
                </div>
                <!-- Aquí aparecerán los vuelos -->
            </section>	

            <section class="container-trips" id="trips-container">
                <!-- Aquí aparecerán los paquetes de turismo -->
            </section>

		</section>

	</main>
	


	<script
		src="https://kit.fontawesome.com/81581fb069.js"
		crossorigin="anonymous"
	></script>


	<script src="script.js?v=1.0"></script>
	
</body>
</html>