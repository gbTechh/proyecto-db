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
        // Buscar vuelos y paquetes
        const response = await fetch('trip.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                origin,
                destination,
                start_date: startDate,
                end_date: endDate
            })
        });
        
        const data = await response.json();
        console.log(data); 
        mostrarResultados(data);

    } catch (error) {
        console.error('Error al buscar vuelos y paquetes turísticos:', error);
        document.getElementById('results').innerHTML = 
            '<p class="error">Error al buscar vuelos o paquetes turísticos. Por favor, intente nuevamente.</p>';
    }
});

function mostrarResultados(data) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    // Mostrar vuelos de ida
    if (data.vuelos.ida && data.vuelos.ida.length > 0) {
        resultsDiv.innerHTML += `
            <section class="vuelos-section">
                <h2>Vuelos de Ida</h2>
                <div class="wrapp-vuelos">
                    ${mostrarVuelos(data.vuelos.ida, "ida")}
                </div>
            </section>
        `;
    }

    // Mostrar vuelos de regreso
    if (data.vuelos.regreso && data.vuelos.regreso.length > 0) {
        resultsDiv.innerHTML += `
            <section class="vuelos-section">
                <h2>Vuelos de Regreso</h2>
                <div class="wrapp-vuelos">
                    ${mostrarVuelos(data.vuelos.regreso, "regreso")}
                </div>
            </section>
        `;
    }

    // Mostrar paquetes turísticos
    if (data.paquetes && data.paquetes.length > 0) {
        resultsDiv.innerHTML += `
            <section class="paquetes-section">
                <h2>Paquetes Turísticos</h2>
                <div class="container-trips">
                    ${mostrarPaquetes(data.paquetes)}
                </div>
            </section>
        `;
    }
    if (data.hoteles && data.hoteles.length > 0) {
        resultsDiv.innerHTML += `
            <section class="hoteles-section">
                <h2>Hoteles</h2>
                <div class="container-trips">
                    ${mostrarHoteles(data.hoteles)}
                </div>
            </section>
        `;
    }
    if (data.transportes && data.transportes.length > 0) {
        resultsDiv.innerHTML += `
            <section class="hoteles-section">
                <h2>Transportes</h2>
                <div class="container-trips">
                    ${mostrarTransportes(data.transportes)}
                </div>
            </section>
        `;
    }
    if (data.servicios && data.servicios.length > 0) {
        resultsDiv.innerHTML += `
            <section class="hoteles-section">
                <h2>Servicios</h2>
                <div class="container-trips">
                    ${mostrarServicios(data.servicios)}
                </div>
            </section>
        `;
    }
    if (data.guiasturisticos && data.guiasturisticos.length > 0) {
        resultsDiv.innerHTML += `
            <section class="guias-section">
                <h2>Guias</h2>
                <div class="container-trips">
                    ${mostrarguias(data.guiasturisticos)}
                </div>
            </section>
        `;
    }
}


function mostrarVuelos(vuelos, tipo) {
    return vuelos.map(vuelo => `
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
                        <span class="info-value date">${vuelo.fecha_salida}</span>
                    </div>
                </div>
                
                <div class="flight-info">
                    <i class="bx bxs-plane-land icon"></i>
                    <div class="info-container">
                        <span class="info-label">Llegada:</span>
                        <span class="info-value date">${vuelo.fecha_llegada}</span>
                    </div>
                </div>
            </div>

            <button onclick="seleccionarVuelo(${vuelo.id}, '${tipo}', '${vuelo.num_vuelo}', '${vuelo.origen}', ${vuelo.precio}, '${vuelo.destino}', '${vuelo.fecha_salida}', '${vuelo.fecha_llegada}' )" class="seleccionar-button">
                Seleccionar Vuelo
            </button>
        </div>
    `).join('');
}

function mostrarPaquetes(paquetes) {
    return paquetes.map(paquete => `
        <div class="card-trips">
            <div class="container-img">
                <img src="" />
                <span class="discount">-13%</span>
            </div>
            <div class="content-card-trips">
                <p class="date"><strong>Ciudad:</strong> ${paquete.ciudad}</p>
                <h3>${paquete.nombre}</h3>
                <p>${paquete.descripcion}</p>
            </div>
            <div class="card-stats">
                <div class="stat">
                    <div class="value">From</div>
                </div>
                <div class="stat"></div>
                <div class="stat">
                    <div class="value">$${paquete.precio}</div>
                </div>
            </div>

            <button onclick="seleccionarPaquete(${paquete.id}, '${paquete.nombre}' ,' ${paquete.descripcion}', '${paquete.ciudad}', ${paquete.precio})" class="seleccionar-button">
                Seleccionar Paquete
            </button>
        </div>
    `).join('');
}
function mostrarHoteles(hoteles) {
    return hoteles.map(hotel => `
        <div class="card-trips">
            <div class="container-img">
                <img src="" />
                <span class="discount">-13%</span>
            </div>
            <div class="content-card-trips">
                <p class="date">Direccion: ${hotel.direccion}</p>
                <h3>${hotel.nombre}</h3>
               <p class="date">categoria: ${hotel.categoria}</p>
               <p class="date">telefono: ${hotel.telefono}</p>
              
            </div>
            <div class="card-stats">
                <div class="stat">
                    <div class="value">From</div>
                </div>
                <div class="stat"></div>
                <div class="stat">
                    <div class="value">$${hotel.precio_por_noche}</div>
                </div>
            </div>

            <button onclick="seleccionarHotel(${hotel.id}, '${hotel.nombre}', '${hotel.direccion}', '${hotel.categoria}', '${hotel.telefono}', ${hotel.precio_por_noche})" class="btn-seleccionar">
                Seleccionar Hotel
            </button>
        </div>
    `).join('');
}
function mostrarTransportes(transportes) {
    return transportes.map(transporte => `
        <div class="flight-card">
            <!-- Encabezado del vuelo -->
            <div class="flight-header">
                <span class="flight-number">${transporte.empresa}</span>
                <span class="flight-price">$${transporte.costo}</span>
            </div>
            
            <!-- Información del vuelo -->
            <div class="flight-info">
                <div class="info-container">
                    <span class="info-label">Tipo:</span>
                    <span class="info-value">${transporte.tipo}</span>
                </div>
            </div>

            <button onclick="seleccionarTransporte(${transporte.id}, '${transporte.empresa}', ${transporte.costo}, '${transporte.tipo}')" class="btn-seleccionar">
                Seleccionar Transporte
            </button>
        </div>
    `).join('');
}
function mostrarServicios(servicios) {
    return servicios.map(servicio => `
        <div class="flight-card">
            <!-- Encabezado del vuelo -->
            <div class="flight-header">
                <span class="flight-number">${servicio.descripcion}</span>
                <span class="flight-price">$${servicio.costo}</span>
            </div>


            <button onclick="seleccionarServicio(${servicio.id}, '${servicio.descripcion}', ${servicio.costo})" class="btn-seleccionar">
                Seleccionar Servicio
            </button>
        </div>
    `).join('');
}
function mostrarguias(guiasturisticos) {
    return guiasturisticos.map(guiaturistico => `
        <div class="flight-card">
            <!-- Encabezado del vuelo -->
            <div class="flight-header">
                <span class="flight-number">${guiaturistico.nombre}</span>
                <span class="flight-price">$${guiaturistico.idioma}</span>
            </div>


            <button onclick="seleccionarguia(${guiaturistico.id}, '${guiaturistico.nombre}', '${guiaturistico.idioma}')" class="btn-seleccionar">
                Seleccionar guia
            </button>
        </div>
    `).join('');
}

function seleccionarguia(id , nombre, idioma) {
    const guiaSeleccionado = {
        id: id,
        nombre: nombre,
        idioma: idioma,
    };
    localStorage.setItem(`guiaSeleccionado`, JSON.stringify(guiaSeleccionado));
    console.log("guia guardado:", guiaSeleccionado);
    alert(`guia seleccionado: ${guiaSeleccionado.id}`);
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

function seleccionarVuelo(id, tipo, num_vuelo, origen, precio, destino, fecha_salida, fecha_llegada) {
    const vueloSeleccionado = {
        id: id,
        tipo: tipo,
        num_vuelo: num_vuelo,
        precio: precio,
        origen: origen,
        destino: destino,
        fecha_salida: fecha_salida,
        fecha_llegada: fecha_llegada
    };
    localStorage.setItem(`vuelo${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`, JSON.stringify(vueloSeleccionado));
    console.log("Vuelo guardado:", vueloSeleccionado);
    alert(`${tipo.charAt(0).toUpperCase() + tipo.slice(1)} seleccionado.`);
}

function seleccionarPaquete(id, nombre, descripcion, ciudad, precio) {
    const paqueteSeleccionado = {
        id: id,
        nombre: nombre,
        descripcion: descripcion,
        ciudad: ciudad,
        precio: precio
    };
    localStorage.setItem(`paqueteSeleccionado`, JSON.stringify(paqueteSeleccionado));
    console.log("Paquete guardado:", paqueteSeleccionado);
    alert(`Paquete seleccionado: ${paqueteSeleccionado.nombre}`);
}

function seleccionarHotel(id, nombre, direccion, categoria, telefono, precio_por_noche) {
    const hotelSeleccionado = {
        id: id,
        nombre: nombre,
        direccion: direccion,
        categoria: categoria,
        telefono: telefono,
        precio_por_noche: precio_por_noche,
    };
    localStorage.setItem(`hotelSeleccionado`, JSON.stringify(hotelSeleccionado));
    console.log("Hotel guardado:", hotelSeleccionado);
    alert(`Hotel seleccionado: ${hotelSeleccionado.nombre}`);
}

function seleccionarTransporte(id , empresa, costo, tipo) {
    const transporteSeleccionado = {
        id: id,
        empresa: empresa,
        costo: costo,
        tipo: tipo
    };
    localStorage.setItem(`transporteSeleccionado`, JSON.stringify(transporteSeleccionado));
    console.log("Transporte guardado:", transporteSeleccionado);
    alert(`Transporte seleccionado: ${transporteSeleccionado.id}`);
}

function seleccionarServicio(id , descripcion, costo) {
    const servicioSeleccionado = {
        id: id,
        descripcion: descripcion,
        costo: costo,
    };
    localStorage.setItem(`servicioSeleccionado`, JSON.stringify(servicioSeleccionado));
    console.log("Servicio guardado:", servicioSeleccionado);
    alert(`Servicio seleccionado: ${servicioSeleccionado.id}`);
}

function datos_seleccionados(id){
    
}
