<div class="transportes">
  <div class="wrapp-title">
    <h1 class="title"><?php echo $title; ?></h1>
    <a class="btn btn-primary" href="vuelos/crear.php?action=crear">
    Agregar transportes
    </a>

  </div>
  <!-- Contenido del Dashboard -->
  <div class="wrapp-transport">
    <?php foreach ($transportes as $transporte) { ?>
     <div class="transport-card">
        <div class="transport-header">
            <span class="transport-price"><?= $transporte->getTipo();?></span>
            <span class="transport-type"><?php echo '$' . $transporte->getCosto();?></span>
        </div>

        <div class="transport-info">
            <i class='bx bx-map'></i>
            <div class="info-container">
                <span class="info-label">Empresa</span>
                <span class="info-value"><?= $transporte->getEmpresa();?></span>
            </div>
        </div>
    </div>
    <?php }?>
  </div>
 
</div>