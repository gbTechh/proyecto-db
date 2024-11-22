
<div class="body-container">
  

  <div class="wrapp-body">
    <div class="form-group">
      <label for="search">Buscar:</label>
      <form class="group" method="post" action="reservas.php?action=search">
        <input id="search" type="text" name="search" placeholder="Buscar reserva..." value="<?= $searchTerm?>"/>
        <button class="btn-search btn btn-primary">Search</button>
      </form>
    </div>
    <?php if((count($searchData) <= 0 || empty($searchTerm))){?>
    <?php if(!empty($searchTerm)){?>
      <h1>No se encontraron resultados...</h1></br>      
    <?php }?>
    <div class="wrapp-title">
        <div class="div-title">         
          <h1>Lista de reservas no confirmadas</h1>
        </div>        
    </div>
    <div class="wrap-noconfirmadas">
      <?php if(empty($reservasPendientes)){?>
        <p>No hay reservas por confirmar</p>  
      <?php }?>
      <?php foreach ($reservasPendientes as $reserva) { ?>
      
        <div class="card pendiente">
          <div class="title">
            <h3>ID: <?= $reserva->getID()?></h3>
              <button data-value="<?= $reserva->getID()?>" class="btn check js-btn-check"><i class='bx bxs-check-square'></i></button>
          
          </div>
          <h2><?= $reserva->getCliente()?></h2>
          <h3><?=formatearFecha($reserva->getFecha())?></h3>
          <span class="state pendiente"><?= $reserva->getEstado()?></span>
        </div>

      <?php }?>
    </div>
    <div class="wrapp-title">
        <div class="div-title">         
          <h1>Lista de reservas confirmadas</h1>
        </div>        
    </div>
    <div class="wrap-noconfirmadas">
      <?php if(empty($reservasConfirmadas)){?>
        <p>No hay reservas confirmadas</p>  
      <?php }?>
      <?php foreach ($reservasConfirmadas as $reserva) { ?>
      
        <div class="card confirmada">
          <h3>ID: <?= $reserva->getID()?></h3>
          <h2><?= $reserva->getCliente()?></h2>
          <h3><?= formatearFecha($reserva->getFecha())?></h3>
          <span class="state confirmada"><?= $reserva->getEstado()?></span>
        </div>

      <?php }?>
    
    </div>
    <?php } else { ?>   
      <div class="wrapp-title">
        <div class="div-title">         
          <h1>Resultados:</h1>
        </div>        
      </div>
      <div class="wrap-noconfirmadas">       
        <?php foreach ($searchData as $data) { ?>
        
          <div class="card <?= strtolower($data->getEstado()) ?>">
            <div class="title">
              <h3>ID: <?= $data->getID()?></h3>
              <?php if($data->getEstado() == 'Pendiente'){?>
                <button data-value="<?= $data->getID()?>" class="btn check js-btn-check"><i class='bx bxs-check-square'></i></button>
              <?php }?>
            
            </div>
            <h2><?= $data->getCliente()?></h2>
            <h3><?=formatearFecha($data->getFecha())?></h3>
            <span class="state <?= strtolower($data->getEstado()) ?>"><?= $data->getEstado()?></span>
          </div>

        <?php }?>
      </div>
    
    <?php }?>
   
  </div>
</div>

<div class="modal">
  <div class="content">
    <div class="head">
      <h3 class="title">Confirmar Reserva</h3>
      <button class="close btn-close">
        <i class='bx bx-x'></i>
      </button>
    </div>
    <div class="body">
      <p>¿Realmente deseas confirmar esta reserva?</p>
    </div>
    <div class="footer">
      <form method="POST" action="reservas.php?action=confirmar">
        <input type="hidden" id="reserva_id" name="id"/>
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </form>

      <button class="btn btn-close">Cancelar</button>
    </div>
  </div>
</div>