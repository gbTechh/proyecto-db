 <?php include ROOT . '/app/views/templates/formateDate.php'; ?>
<div class="vuelos">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary" href="vuelos/crear">
    Agregar ciudades
    </a>

  </div>
  <!-- Contenido del Dashboard -->
  <div class="wrapp-ciudad">
    <?php foreach ($ciudades as $ciudad) { ?>
      <div class="city-card">
          <div class="city-header">
              <h2 class="city-name"><?= $ciudad->getNombre();?></h2>
              <span class="city-country"><?= $ciudad->getPais();?></span>
          </div>

          <div class="city-info">
              <i class='bx bx-user-voice'></i>
              <div class="info-container">
                  <span class="info-label">Guías Turísticos</span>
                  <span class="info-value"><?= $ciudad->getGuias();?></span>
              </div>
          </div>

          <div class="city-info">
              <i class='bx bx-hotel'></i>
              <div class="info-container">
                  <span class="info-label">Hoteles</span>
                  <span class="info-value"><?= $ciudad->getHoteles();?></span>
              </div>
          </div>

          <!-- <div class="city-info">
              <i class='bx bx-plane'></i>
              <div class="info-container">
                  <span class="info-label">Vuelos Diarios</span>
                  <span class="info-value">750</span>
              </div>
          </div> -->
      </div>
    <?php }?>
  </div>
 
</div>