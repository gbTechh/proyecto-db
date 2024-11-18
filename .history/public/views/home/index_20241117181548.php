<?php
session_start();
?>
<section class="banner">
  <div class="content-banner">	
  <?php if (isset($_SESSION['username'])): ?>
    <h2 id="saludo">Hola, <?php echo htmlspecialchars($_SESSION['nombre'] ?? 'Usuario Desconocido'); ?></h2>
  <?php else: ?>
    <h2 id="saludo">Hola!</h2>
  <?php endif; ?>
    
      
    
    <p>Bienvenidos a</p>
    <h2>Arequipa <br />Ciudad Blanca</h2>
    <a href="<?php echo URLROOT . "/trip.php"?>">Tu viaje comienza aquí</a>
  </div>
</section>


<main class="main-content">
  <section class="container container-features">
    <div class="card-feature">
      <i class="fa-regular fa-star"></i>
      <div class="feature-content">
        <span>13+ YEARS OF EXPERIENCE</span>
        <p>We have experience in the tourism industry, over 50,000 customers have traveled with us.</p>
      </div>
    </div>
    <div class="card-feature">
      <i class="fa-solid fa-map-location-dot"></i>
      <div class="feature-content">
        <span>20+ DESTINATIONS</span>
        <p>We can help you plan the vacation of your dreams.</p>
      </div>
    </div>
    <div class="card-feature">
      <i class="fa-solid fa-square-h"></i>
      <div class="feature-content">
        <span>LUXURY HOTELS</span>
        <p>We have more than 10 agreements with luxurious hotoles.</p>
      </div>
    </div>
    <div class="card-feature">
      <i class="fa-solid fa-headset"></i>
      <div class="feature-content">
        <span>TOP NOTCH SUPPORT</span>
        <p>You can consult and book your trip with us online, easily, quickly and safely.</p>
      </div>
    </div>
  </section>

  <section class="container top-categories">
    <h1 class="heading-1">Destinos Populares</h1>
    <div class="container-categories">
      <div class="card-category category-colca">
        <p>Colca</p>
        <span>Ver más</span>
      </div>
      <div class="card-category category-cotahuasi">
        <p>Cotahuasi</p>
        <span>Ver más</span>
      </div>
      <div class="card-category category-salinas">
        <p>Salinas</p>
        <span>Ver más</span>
      </div>
    </div>
  </section>

  
  <section class="container top-trips">
    <h1 class="heading-1">Seguro te encantará</h1>

    <div class="container-options">
      <p>Find you ideal tour, here we offer you the best selection of trips to Arequipa. Allow yourself to be seduced by the history, culture and nature of Arequipa.</p>
    </div>
    

    <div class="container-trips">
      
      <div class="card-trips" >
        <div class="container-img">
          <img src="<?= image("colca2.jpg")?>" alt="Colca Full Day" />
          <span class="discount">-13%</span>

        </div>
        <div class="content-card-trips">
          <span class="date">2 días y 1 noche</span>
          <h3>Colca Full Day</h3>
          <p class="list_info">
            <i class="fa fa-location-dot"></i> Provincia de Caylloma<br />
            <i class="fa fa-bed" ></i> Accommodations included<br />
            <i class="fa fa-bus"></i> Transfers included<br />
            <i class="fa fa-flag-o"></i> Activities and excursions<br />
            <i class="fa fa-coffee"></i> Breakfast included<br />
            <i class="fa fa-calendar"></i> Daily departures<br />
          </p>
        </div>
        <div class="card-stats">
          <div class="stat">
            <div class="value">From</div>
          </div>
          <div class="stat">
            <div class="value"></div>
          </div>
          <div class="stat">
            <div class="value">US$180</div>
          </div>
        </div>
      </div>


      <div class="card-trips">
        <div class="container-img">
          <img src="<?= image("cotahuasi.jpg")?>" alt="Cotahuasi" />
          <span class="discount">-13%</span>

        </div>
        <div class="content-card-trips">
          <span class="date">3 days</span>
          <h3>Cañon de Cotahuasi</h3>
          <p class="list_info">
            <i class="fa fa-location-dot"></i> Provincia La Union<br />
            <i class="fa fa-bed" ></i> Accommodations included<br />
            <i class="fa fa-bus"></i> Transfers included<br />
            <i class="fa fa-flag-o"></i> Activities and excursions<br />
            <i class="fa fa-coffee"></i> Breakfast included<br />
            <i class="fa fa-calendar"></i> Daily departures<br />
          </p>
        </div>
        <div class="card-stats">
          <div class="stat">
            <div class="value">From</div>
          </div>
          <div class="stat">
            <div class="value"></div>
          </div>
          <div class="stat">
            <div class="value">US$300</div>
          </div>
        </div>
      </div>

      <div class="card-trips">
        <div class="container-img">
          <img src="<?= image("salinas.jpg")?>" alt="Colca Full Day" />
          <span class="discount">-13%</span>

        </div>
        <div class="content-card-trips">
          <span class="date">1 días</span>
          <h3>Laguna Salinas</h3>
          <p class="list_info">
            <i class="fa fa-location-dot"></i> Provincia Arequipa and Caylloma<br />
            <i class="fa fa-bed" ></i> Accommodations included<br />
            <i class="fa fa-bus"></i> Transfers included<br />
            <i class="fa fa-flag-o"></i> Activities and excursions<br />
            <i class="fa fa-coffee"></i> Breakfast included<br />
            <i class="fa fa-calendar"></i> Daily departures<br />
          </p>
        </div>
        <div class="card-stats">
          <div class="stat">
            <div class="value">From</div>
          </div>
          <div class="stat">
            <div class="value"></div>
          </div>
          <div class="stat">
            <div class="value">US$60</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="gallery">
    <img src="<?= image("salinas.jpg")?>" alt="Gallery Img1" class="gallery-img-1"/>
    <img src="<?= image("colcacanyon.jpg")?>" alt="Gallery Img2" class="gallery-img-2"/>
    <img src="<?= image("catedral.jpg")?>" alt="Gallery Img3" class="gallery-img-3"/>
    <img src="<?= image("pillones.avif")?>" alt="Gallery Img4" class="gallery-img-4"/>
    <img src="<?= image("piedras.webp")?>" alt="Gallery Img5" class="gallery-img-5"/>
  </section>

  

  
</main>