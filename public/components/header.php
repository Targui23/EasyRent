<?php

    // session_start(); // Avvia la sessione

    //Verifica se l'utente è connesso
    $user_connected = isset($_SESSION['user_connected']) && $_SESSION['user_connected'] === "ok";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/css/headerstyle.css">
    <link href="/assets/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    
   
</head>
<body>
    <header class="mainheader">
        <a href="/public/index.php"><img src="/img/logoo.png" alt="logo header" class="logoheader" "></a>
        <nav>
            <ul class="top_sidebar">
                <li>
                    <a href="/public/index.php">Accueil </a>
                </li>
                <li><a href="/public/catalogue.php">Catalogue</a>
                </li>
                <li><a href="/public/index.php#services">Nos services</a></li>
                <li><a href="/public/index.php#about_us">A propose</a></li>
                <li><a href="/public/index.php#contact_us">Contact</a></li>
                <li><a href="/admin/logout.php">Log Out</a></li>
                <?php 

                    
                   
                    // if (isset($_SESSION['user_connected']) && $_SESSION['user_connected'] === "ok") {
                    //     var_dump($_SESSION);
                    //     exit;
                    //     echo '<li><a href="/admin/logout.php">Log Out</a></li>';
                    
                    // } 

                    
                ?>
            </ul>
            <ul class="side_bar">
                <div>
                    <img src="../img/icon/close_menu.png" alt="" class="close_menu" onclick=hidenSideBar()>
                </div>
                <li>
                    <a href="/public/index.php">Accueil </a>
                </li>
                <li>
                    <a href="/public/catalogue.php">Catalogue</a>
                </li>
                <li>
                    <a href="/public/index.php#services">Nos services</a>
                </li>
                <li>
                    <a href="/public/index.php#about_us">A propose</a>
                </li>
                <li>
                    <a href="/public/index.php#contact_us">Contact</a>
                </li>
                
                
                
            </ul>
        </nav>

        <?php if(isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == "ok"){ ?>
            <li class="login">
                <a class="login" href="/admin/login.php">
                        <i class="fa-solid fa-bars"></i>
                </a>
            </li>
        <?php }else { ?>
            <li class="login">
                <a class="login" href="/admin/login.php">
                        <i class="fa-solid fa-house-user "></i>
                </a>
            </li>
            <img src="../img/icon/icon_open.png" alt="" class="menu_navbar" onclick=showSideBar()>
        <?php  } ?>
        
        
       
        
    </header>
</body>
<script src="../js/headerjs.js"></script>
</html>