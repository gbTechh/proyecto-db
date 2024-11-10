<!-- Barra de navegacion -->
<nav class="sidebar">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo AssetHelper::image("travel-agency-logo.jpg")?>" alt="logo">
            </span>
            
            <div class="text header-text">
                <span class="name">Agencia de Viajes</span>
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
                    <li class="nav-link">
                        <a href="<?php echo URLROOT . "/admin/sucursal"?>">
                            <i class='bx bx-briefcase icon'></i>
                            <span class="text nav-text">Sucursales</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?php echo URLROOT . "/admin/empleados"?>">
                            <i class='bx bx-briefcase icon'></i>
                            <span class="text nav-text">Empleadoss</span>
                        </a>
                    </li>
                    <li class="nav-link">
                       <a href="<?php echo URLROOT . "/admin/clientes"?>">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#reservas">
                            <i class='bx bx-calendar-alt icon'></i>
                            <span class="text nav-text">Reservas</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="#hoteles">
                            <i class='bx bx-hotel icon'></i>
                            <span class="text nav-text">Hoteles</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#viajes">
                            <i class='bx bx-map icon'></i>
                            <span class="text nav-text">Viajes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                         <a href="<?php echo URLROOT . "/admin/vuelos"?>">
                            <i class='bx bxs-plane-take-off icon'></i>
                            <span class="text nav-text">Vuelos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                         <a href="<?php echo URLROOT . "/admin/ciudades"?>">
                            <i class='bx bx-world icon'></i>
                            <span class="text nav-text">Ciudades</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>      
            </div>
        </div>
</nav>
