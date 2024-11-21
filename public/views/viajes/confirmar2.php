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
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<main class="main-content">
    <h1 class="heading-1">Confirm your trip!</h1>
    <p class="parrafo">Todo listo para esta gran aventura, ¡te esperamos!</p>
    <h2 class="hover-area">
        <?php echo htmlspecialchars($_SESSION['dni'] ?? 'Usuario Desconocido') . ' ' . htmlspecialchars($_SESSION['apellidos'] ?? ''); ?>
    </h2>

    <form action="procesar_viaje.php" method="POST">
        <section class="container summary">
            <div class="summary-column image-column">
                <img id="destino-imagen" src="" alt="Destination Image" />
            </div>
            <div class="summary-column details-column">
                <h3>Resumen de tu viaje</h3>

                <div id="vuelo-ida"></div>
                <div id="vuelo-regreso"></div>
                <div id="paquete-seleccionado"></div>
                

                <!-- Campos ocultos para enviar los datos -->
                <input type="hidden" name="vuelo_ida" value="" id="vuelo_ida_input">
                <input type="hidden" name="vuelo_regreso" value="" id="vuelo_regreso_input">
                <input type="hidden" name="paquete" value="" id="paquete_input">
                <input type="hidden" name="servicio" value="" id="servicio_input">
                <input type="hidden" name="guia" value="" id="guia_input">
                <input type="hidden" name="hotel" value="" id="hotel_input">
                <input type="hidden" name="transporte" value="" id="transporte_input">
                <input type="hidden" name="precio_total" id="precio_total_input">
                <input type="hidden" name="duracion_viaje" id="duracion_viaje_input">
            </div>
        </section>

        <div id="precio-total"></div>
        <div id="duracion-viaje"></div>
        <button type="submit">Confirmar reserva</button>

    </form>
</main>

<script>
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleDateString('es-ES', options);
    }

    function calculateDuration(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); // Duración en días
        return duration > 0 ? duration : 0; // Devuelve un número
    }
    document.querySelector('form').addEventListener('submit', function () {
        const precioTotal = parseFloat(document.getElementById('precio-total').textContent.replace('$', '')) || 0;
        const duracionviaje = document.getElementById('duracion-viaje').textContent.trim();
       
    });
    document.addEventListener('DOMContentLoaded', function () {
        const vueloIda = JSON.parse(localStorage.getItem('vueloIda'));
        const vueloRegreso = JSON.parse(localStorage.getItem('vueloRegreso'));
        const paquete = JSON.parse(localStorage.getItem('paqueteSeleccionado'));
        const transporte = JSON.parse(localStorage.getItem('transporteSeleccionado'));
        const servicio = JSON.parse(localStorage.getItem('servicioSeleccionado'));
        const hotel = JSON.parse(localStorage.getItem('hotelSeleccionado'));
        const guia = JSON.parse(localStorage.getItem('guiaSeleccionado'));
        

        // Variables para calcular el precio total
        let precioTotal = 0;

        // Mostrar detalles y sumar precios
        if (vueloIda) {
            precioTotal += parseFloat(vueloIda.precio || 0);
            document.getElementById('vuelo-ida').innerHTML = `
                <h3>Vuelo de Ida:</h3>
                 ${vueloIda.id}
                <p>Número de Vuelo: ${vueloIda.num_vuelo}</p>
                <p>Origen: ${vueloIda.origen}</p>
                <p>Destino: ${vueloIda.destino}</p>
                <p>Salida:  ${formatDate(vueloIda.fecha_salida)}</p>
                <p>Llegada: ${formatDate(vueloIda.fecha_llegada)}</p>
                <p>precio: $${vueloIda.precio}</p>
            `;
        }

        if (vueloRegreso) {
            precioTotal += parseFloat(vueloRegreso.precio || 0);
            document.getElementById('vuelo-regreso').innerHTML = `
                <h3>Vuelo de Regreso:</h3>
                 ${vueloRegreso.id}
                <p>Número de Vuelo: ${vueloRegreso.num_vuelo}</p>
                <p>Origen: ${vueloRegreso.origen}</p>
                <p>Destino: ${vueloRegreso.destino}</p>
                <p>Salida: ${formatDate(vueloRegreso.fecha_salida)}</p>
                <p>Llegada: ${formatDate(vueloRegreso.fecha_llegada)}</p>
                <p>precio: $${vueloRegreso.precio}</p>
            `;
        }

        if (paquete) {
            precioTotal += parseFloat(paquete.precio || 0);
            document.getElementById('paquete-seleccionado').innerHTML = `
                <h3>Paquete Seleccionado:</h3>
                 ${paquete.id}
                <p>nombre: ${paquete.nombre}</p>
                <p>Descripción: ${paquete.descripcion}</p>
                <p>ciudad: ${paquete.ciudad}</p>
                <p>precio: $${paquete.precio}</p>
            `;
        }
        if (hotel) {
            const hotelDiv = document.createElement('div');
            hotelDiv.innerHTML = `
                <h3>hotel Seleccionado:</h3>
                 ${hotel.id}
                <p>nombre: ${hotel.nombre}</p>
                <p>Dirección: ${hotel.direccion}</p>
                <p>Categoría: ${hotel.categoria}</p>
                <p>Teléfono: ${hotel.telefono}</p>
                <p>precio/noche: $${hotel.precio_por_noche}</p>
            `;
            document.querySelector('.details-column').appendChild(hotelDiv);
        }

        if (transporte) {
            const transporteDiv = document.createElement('div');
            transporteDiv.innerHTML = `
                <h3>transporte Seleccionado:</h3>
                 ${transporte.id}
                <p>Empresa: ${transporte.empresa}</p>
                <p>Tipo: ${transporte.tipo}</p>
                <p>costo: $${transporte.costo}</p>
            `;
            document.querySelector('.details-column').appendChild(transporteDiv);
        }

        if (servicio) {
            const servicioDiv = document.createElement('div');
            servicioDiv.innerHTML = `
                <h3>servicio Seleccionado:</h3>
                 ${servicio.id}
                <p>Descripción: ${servicio.descripcion}</p>
                <p>costo: $${servicio.costo}</p>
            `;
            document.querySelector('.details-column').appendChild(servicioDiv);
        }
        if (guia) {
            const guiaDiv = document.createElement('div');
            guiaDiv.innerHTML = `
                <h3>guia Seleccionado:</h3>
                 ${guia.id}
                <p>Descripción: ${guia.nombre}</p>
                <p>costo: $${guia.idioma}</p>
            `;
            document.querySelector('.details-column').appendChild(guiaDiv);
        }

        if (hotel) {
            precioTotal += parseFloat(hotel.precio_por_noche || 0);
        }
        if (transporte) {
            precioTotal += parseFloat(transporte.costo || 0);
        }
        if (servicio) {
            precioTotal += parseFloat(servicio.costo || 0);
        }
        document.getElementById('precio-total').innerHTML = `
            <h3>precio Total:</h3>
            <p>$${precioTotal.toFixed(2)}</p>
        `;
        if (vueloIda && vueloRegreso) {
            const duracion = calculateDuration(vueloIda.fecha_salida, vueloRegreso.fecha_llegada);
            document.getElementById('duracion-viaje').innerHTML = `
                <h3>Duración del viaje:</h3>
                <p>${duracion} días</p>
            `;
            document.getElementById('duracion_viaje_input').value = duracion; // Solo el número
        }

        

        document.getElementById('vuelo_ida_input').value = JSON.stringify(vueloIda);
        document.getElementById('vuelo_regreso_input').value = JSON.stringify(vueloRegreso);
        document.getElementById('paquete_input').value = JSON.stringify(paquete);
        document.getElementById('servicio_input').value = JSON.stringify(servicio);
        document.getElementById('guia_input').value = JSON.stringify(guia);
        document.getElementById('hotel_input').value = JSON.stringify(hotel);
        document.getElementById('transporte_input').value = JSON.stringify(transporte);
        document.getElementById('precio_total_input').value = precioTotal;
    });
</script>
</body>
</html>
