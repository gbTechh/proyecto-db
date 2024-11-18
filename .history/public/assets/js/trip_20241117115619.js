document.getElementById('search-form').addEventListener('submit', async function (e) {
    e.preventDefault(); // Evitar que se recargue la página

    const origin = document.getElementById('origin-city').value;
    const destination = document.getElementById('destination-city').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;

    if (!origin || !destination || !startDate || !endDate) {
        alert('Por favor completa todos los campos.');
        return;
    }

    try {
        // Buscar vuelos
        const vuelosResponse = await fetch('trip.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                origin,
                destination,
                start_date: startDate,
                end_date: endDate
            })
        });

        const vuelos = await vuelosResponse.json();
        console.log('Vuelos recibidos:', vuelos);
        mostrarVuelos(vuelos);




    } catch (error) {
        console.error('Error al buscar vuelos y paquetes turísticos:', error);
        document.getElementById('results').innerHTML = 
            '<p class="error">Error al buscar vuelos o paquetes turísticos. Por favor, intente nuevamente.</p>';
    }
});

function mostrarPaquetes(paquetes) {
    const tripsContainer = document.getElementById('trips-container');
    tripsContainer.innerHTML = '';  // Limpiar los paquetes anteriores

    if (paquetes.length > 0) {
        paquetes.forEach(paquete => {
            const paqueteElement = document.createElement('div');
            paqueteElement.classList.add('paquete');
            paqueteElement.innerHTML = `
                <p>Paquete: ${paquete.nombre}</p>
                <p>Descripción: ${paquete.descripcion}</p>
                <p>Precio: ${paquete.precio}</p>
            `;
            tripsContainer.appendChild(paqueteElement);
        });
    } else {
        tripsContainer.innerHTML = '<p>No se encontraron paquetes turísticos para esta ciudad.</p>';
    }
}

function mostrarVuelos(vuelos) {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = ''; // Limpiar resultados anteriores

    if (vuelos.ida.length === 0 && vuelos.regreso.length === 0) {   
        resultsContainer.innerHTML = '<p>No se encontraron vuelos para los criterios seleccionados.</p>';
        return;
    }

    // Mostrar vuelos de ida
    const idaContainer = document.createElement('div');
    idaContainer.innerHTML = '<h2>Vuelos de Ida</h2>';
    vuelos.ida.forEach(vuelo => {
        const vueloCard = `
            <div class="flight-card">
                <!-- Encabezado del vuelo -->
                <div class="flight-header">
                    <span class="flight-number">${vuelo.num_vuelo}</span>
                    <span class="flight-price">$${vuelo.precio}</span>
                </div>
                
                <!-- Información del vuelo -->
                <div class="flight-info">
                    <i class="bx bx-map"></i>
                    <div class="info-container">
                        <span class="info-label">Origen:</span>
                        <span class="info-value">${vuelo.origen}</span>
                    </div>
                </div>
                
                <div class="flight-info">
                    <i class="bx bx-map-pin"></i>
                    <div class="info-container">
                        <span class="info-label">Destino:</span>
                        <span class="info-value">${vuelo.destino}</span>
                    </div>
                </div>
                
                <!-- Horarios del vuelo -->
                <div class="flight-times">
                    <div class="flight-info">
                        <i class="bx bxs-plane-alt icon"></i>
                        <div class="info-container">
                            <span class="info-label">Salida:</span>
                            <span class="info-value date">${formatearFecha(vuelo.fecha_salida)}</span>
                        </div>
                    </div>
                    
                    <div class="flight-info">
                        <i class="bx bxs-plane-land icon"></i>
                        <div class="info-container">
                            <span class="info-label">Llegada:</span>
                            <span class="info-value date">${formatearFecha(vuelo.fecha_llegada)}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        idaContainer.innerHTML += vueloCard;
    });

    // Mostrar vuelos de regreso
    const regresoContainer = document.createElement('div');
    regresoContainer.classList.add('wrapp-vuelos'); // Clase principal para el contenedor
    regresoContainer.innerHTML = '<h2>Vuelos de Regreso</h2>';
    vuelos.regreso.forEach(vuelo => {
        const vueloCard = `
            <div class="flight-card">
                <!-- Encabezado del vuelo -->
                <div class="flight-header">
                    <span class="flight-number">${vuelo.num_vuelo}</span>
                    <span class="flight-price">$${vuelo.precio}</span>
                </div>
                
                <!-- Información del vuelo -->
                <div class="flight-info">
                    <i class="bx bx-map"></i>
                    <div class="info-container">
                        <span class="info-label">Origen:</span>
                        <span class="info-value">${vuelo.origen}</span>
                    </div>
                </div>
                
                <div class="flight-info">
                    <i class="bx bx-map-pin"></i>
                    <div class="info-container">
                        <span class="info-label">Destino:</span>
                        <span class="info-value">${vuelo.destino}</span>
                    </div>
                </div>
                
                <!-- Horarios del vuelo -->
                <div class="flight-times">
                    <div class="flight-info">
                        <i class="bx bxs-plane-alt icon"></i>
                        <div class="info-container">
                            <span class="info-label">Salida:</span>
                            <span class="info-value date">${formatearFecha(vuelo.fecha_salida)}</span>
                        </div>
                    </div>
                    
                    <div class="flight-info">
                        <i class="bx bxs-plane-land icon"></i>
                        <div class="info-container">
                            <span class="info-label">Llegada:</span>
                            <span class="info-value date">${formatearFecha(vuelo.fecha_llegada)}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        regresoContainer.innerHTML += vueloCard;
    });

    resultsContainer.appendChild(idaContainer);
    resultsContainer.appendChild(regresoContainer);
}




function formatearFecha(fecha) {
    const date = new Date(fecha); // Convierte la cadena en un objeto Date

    // Lista de los meses en español
    const meses = [
        'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
        'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
    ];

    // Formateamos la fecha en formato 'd de mes del yyyy'
    const dia = String(date.getDate()).padStart(2, '0'); // Día con 2 dígitos
    const mes = meses[date.getMonth()]; // Nombre del mes
    const año = date.getFullYear(); // Año

    return `${dia} de ${mes} del ${año}`; // Devuelve la fecha formateada
}
