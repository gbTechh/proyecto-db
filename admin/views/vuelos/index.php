
<div class="body-container">
  <div class="wrapp-body">
    <div class="wrapp-title">
        <h1 class="title"><?php echo $title . " (" .$vuelos[0]->getTotal() . " )"; ?></h1>
        <a class="btn btn-primary" href="vuelos/crear">
        Agregar vuelos
        </a>

    </div>
    <!-- Contenido del Dashboard -->
    <div class="wrapp-vuelos">

        <?php foreach ($vuelos as $vuelo) { ?>
        <div class="flight-card">
            <div class="flight-header">
                <span class="flight-number"><?= $vuelo->getNumVuelo();?></span>
                <span class="flight-price"><?php echo '$' . $vuelo->getPrecio();?></span>
            </div>

            <div class="flight-info">
                <i class='bx bx-map'></i>
                <div class="info-container">
                    <span class="info-label">Origen</span>
                    <span class="info-value"><?= $vuelo->getCiudadDestino();?></span>
                </div>
            </div>

            <div class="flight-info">
                <i class='bx bx-map-pin'></i>
                <div class="info-container">
                    <span class="info-label">Destino</span>
                    <span class="info-value"><?= $vuelo->getCiudadOrigen();?></span>
                </div>
            </div>

            <div class="flight-times">
                <div class="flight-info">
                    <i class='bx bxs-plane-alt icon' ></i>
                    <div class="info-container">
                        <span class="info-label">Salida</span>
                        <span class="info-value date"><?= formatearFecha($vuelo->getFechaSalida());?></span>
                    </div>
                </div>

                <div class="flight-info">
                    <i class='bx bxs-plane-land icon' ></i>
                    <div class="info-container">
                        <span class="info-label">Llegada</span>
                        <span class="info-value date"><?= formatearFecha($vuelo->getFechaLlegada());?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>

        
    </div>

        <?php echo $paginator->render(); ?>
  </div>
 
</div>