<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url ?>Assets/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/header.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/usuarios.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <nav class="sidebar close">
        <!-- <a href="<?php echo base_url; ?>Administracion/home">Planillas</a>
    <button class="navbar__btn-hamburger" ><ion-icon name="menu-outline"></ion-icon></button>
    <ul class="navbar__ul-menu">
        <li class="ul-menu__li">
            <a  class="li__item" href="#" role="button" >
                <span>EN linea</span>
                <ion-icon name="person-outline" ></ion-icon>
                <ion-icon name="chevron-down-outline"></ion-icon>
            </a>
            <ul class="ul-menu__desplegable">
                <li class="desplegable__item"><a href="">Perfil</a></li>
                <li class="desplegable__item"><a href="">Cerrar</a></li>
            </ul> 
        </li>
    </ul> -->

        <header class="header">
            <div class="header__image-perfil">
                <span class="image-perfil">
                    <img src="<?php echo base_url; ?>Assets/img/log.jpg" alt="">
                </span>
            </div>

            <div class="header__text header__text--image-perfil-text text">
                <span class="username">admin</span>
                <span class="correo">hamjodev@gmail.com</span>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="Container-menubar">
            <div class="menubar">
                <ul class="menubar__links">
                    <li class="nav-linkp">
                        <a href="<?php echo base_url; ?>Usuarios">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Usuarios</span>
                        </a>
                    </li>

                    <li class="nav-linkp">
                        <a href="<?php echo base_url; ?>Planillas"">
                            <i class='bx bx-calculator icon'></i>
                            <span class="text nav-text">Planilla</span>
                        </a>
                    </li>

                    <li class="nav-linkp">
                        <a href="<?php echo base_url; ?>Empleados">
                            <i class='bx bx-male-female icon'></i>
                            <span class="text nav-text">Empleados</span>
                        </a>
                    </li>

                    <li class="nav-linkp">
                        <a href="<?php echo base_url; ?>Cargos">
                            <i class='bx bx-id-card icon'></i>
                            <span class="text nav-text">Cargos</span>
                        </a>
                    </li>

                    <li class="nav-linkp desplegable">
                        <a href="#" role="button" class="desplegable-btn">
                            <i class='bx bxs-discount icon'></i>
                            <span class="text nav-text">Descuento</span>
                        </a>

                        <ul class='menu-desplegable'>
                            <li class="nav-linkp"><a class="text nav-text" href="<?php echo base_url; ?>Descuentos">Descuento</a></li>
                            <li class="nav-linkp"><a class="text nav-text" href="<?php echo base_url; ?>Descuentos/tpDescuentos">Tipo de Descuento</a></li>
                        </ul>
                    </li>

                    <li class="nav-linkp desplegable">
                        <a href="#" role='button' class="desplegable-btn">
                            <i class='bx bx-happy-alt icon'></i>
                            <span class="text nav-text">Bono</span>
                        </a>

                        <ul class='menu-desplegable'>
                            <li class="nav-linkp"><a class="text nav-text" href="<?php echo base_url; ?>Bonos">Bono</a></li>
                            <li class="nav-linkp"><a class="text nav-text" href="<?php echo base_url; ?>Bonos/tpBonos">Tipo de bono</a></li>
                        </ul>
                    </li>

                    <li class="nav-linkp">
                        <a href="<?php echo base_url; ?>Anticipos">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Anticipos</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="nav-linkp">
                    <a href="<?php echo base_url; ?>Usuarios/salir">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Cerrar Sesión</span>
                    </a>

                </li>

                <li class="mode nav-linkp">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>

                </li>
            </div>

        </div>

    </nav>