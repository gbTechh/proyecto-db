
<!-- Barra de navegacion -->
<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo AssetHelper::imageAdmin("travel-agency-logo.jpg")?>" alt="logo">
            </span>
            
            <div class="text header-text">
                <span class="name"><?= $_SESSION['empleado']['sucursal']?></span>
            </div>
        </div>
    </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="index.php">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>
                    <?php if($rol == "Administrador") {?>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT . "/admin/sucursales.php"?>">
                            <i class='bx bx-briefcase icon'></i>
                            <span class="text nav-text">Sucursales</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente") {?>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT . "/admin/empleados.php"?>">
                            <i class='bx bx-briefcase icon'></i>
                            <span class="text nav-text">Empleados</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                       <a href="<?php echo URLROOT . "/admin/clientes.php"?>">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                        <a href="#reservas">
                            <i class='bx bx-calendar-alt icon'></i>
                            <span class="text nav-text">Reservas</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                    <a href="<?php echo URLROOT . "/admin/hoteles.php"?>">
                            <i class='bx bx-hotel icon'></i>
                            <span class="text nav-text">Hoteles</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT . "/admin/viajes.php"?>">
                            <i class='bx bx-map icon'></i>
                            <span class="text nav-text">Viajes</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                         <a href="<?php echo URLROOT . "/admin/vuelos.php"?>">
                            <i class='bx bxs-plane-take-off icon'></i>
                            <span class="text nav-text">Vuelos</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                         <a href="<?php echo URLROOT . "/admin/ciudades.php"?>">
                            <i class='bx bxs-city icon' ></i>
                            <span class="text nav-text">Ciudades</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($rol == "Administrador" || $rol == "Gerente" || $rol == "Vendedor") {?>
                    <li class="nav-link">
                         <a href="<?php echo URLROOT . "/admin/guia_turistico.php"?>">
                            <i class='bx bx-world icon'></i>
                            <span class="text nav-text">Guías Turísticos</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="<?= URLROOT . "/admin/logout.php"?>">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>      
            </div>
        </div>
</nav>
