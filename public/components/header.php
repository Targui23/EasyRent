<?php

    // $user_connected = isset($_SESSION['user_connected']) && $_SESSION['user_connected'] === "ok";
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/css/headerstyle.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>
<body>
    <header class="mainheader">
        <a href="/public/index.php"><img src="/img/logoo.png" alt="logo header" id="logo_header"></a>
        <nav>
            <ul class="top_sidebar">
                <li><a href="/public/index.php">Accueil</a></li>
                <li><a href="/public/catalogue.php">Catalogue</a></li>
                <li><a href="/public/index.php#services">Nos services</a></li>
                <li><a href="/public/index.php#about_us">A propose</a></li>
                <li><a href="/public/index.php#contact_us">Contact</a></li>
            </ul>
            <ul class="side_bar">
                <div>
                    
                    <img src="../img/icon/close_menu.png" alt="Close Menu" class="close_menu" onclick="hidenSideBar()">
                </div>
                <li><a href="/public/index.php">Accueil</a></li>
                <li><a href="/public/catalogue.php">Catalogue</a></li>
                <li><a href="/public/index.php#services">Nos services</a></li>
                <li><a href="/public/index.php#about_us">A propose</a></li>
                <li><a href="/public/index.php#contact_us">Contact</a></li>
                <?php if(isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == "ok"){ ?>
                    
                    <li><a href="/admin/dashboard/dashboard_admin.php">Espace Personnel</a></li>
                    <li><a href="/admin/logout.php">Log out</a></li>
                <?php } else { ?>
                    <li><a href="/admin/login.php">Log In</a></li>
                <?php } ?>
            </ul>
        </nav>

        <div class="header-right">
            <?php if(isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == "ok"){ ?>
                <span class="loged">
                    <li class="login-icon">
                        <a class="login-icon" href="/admin/dashboard/dashboard_admin.php">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    </li>
                    <li class="logot-icon">
                        <a class="logot-icon" href="/admin/logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </a>
                    </li>
                </span>
            <?php } else { ?>
                <span class="loged">
                    <li class="login-icon">
                        <a class="login-icon" href="/admin/login.php">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </a>
                    </li>
                </span>
            <?php } ?>
            <!-- Icona della barra laterale per schermi piccoli -->
            <i class="fa-solid fa-bars menu_navbar" onclick="showSideBar()"></i>
        </div>
    </header>
    <script src="../js/headerjs.js"></script>
</body>
</html>

