<?php

    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

    
   





?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!--<link rel="stylesheet" href="./css/xcxstyle.css"> -->
    <style>
                /* Reset dei margini e dei padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Stile per il corpo della pagina */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        /* Stile per la dashboard */
        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #f9f9f9;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Stile per la barra laterale (sidebar) */
        .sidebar {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sidebar h2 {
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            /* Testo bianco */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a i {
            margin-right: 10px;
        }

        .sidebar ul li a:hover {
            background-color: #555;
            /* Grigio scuro */
        }

        /* Stile per il contenitore principale (main) */
        .main {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Stile generale per i pannelli */
        .panel {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .panel h2 {
            font-size: 1.6rem;
            color: #333;
            margin-bottom: 10px;
        }

        /* Stili specifici per i pannelli */
        .settings-panel {
            background-color: #f0f0f0;
            /* Grigio chiaro */
        }

        .users-panel {
            background-color: #e0f7fa;
            /* Azzurro */
        }

        .products-panel {
            background-color: #e8eaf6;
            /* Lavanda */
        }

        .reservations-panel {
            background-color: #f0f4c3;
            /* Giallo pallido */
        }

        /* Effetto ombra su hover */
        .panel:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        /* Icone */
        .icon {
            margin-right: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 100%;
                order: 2;
                padding: 20px 0;
            }

            .main {
                width: 100%;
                order: 1;
                padding: 20px;
            }
        }
    </style>
</head>
<?php require __ROOT__ .'/public/components/header.php'; ?>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <h2>Dashboard</h2>
            <ul>
                <li><a href="#settings"><i class="fas fa-cog"></i> Impostazioni</a></li>
                <li><a href="#users"><i class="fas fa-users"></i> Account Utenti</a></li>
                <li><a href="#products"><i class="fas fa-box"></i> Prodotti</a></li>
                <li><a href="#reservations"><i class="fas fa-calendar-alt"></i> Prenotazioni</a></li>
            </ul>
        </div>
        <div class="main">
            <div id="settings" class="panel">
                <h2><i class="fas fa-cog"></i> Impostazioni</h2>
                <p>Contenuto delle impostazioni...</p>
            </div>
            <div id="users" class="panel">
                <h2><i class="fas fa-users"></i> Account Utenti</h2>
                <p>Contenuto degli account utenti...</p>
            </div>
            <div id="products" class="panel">
                <h2><i class="fas fa-box"></i> Prodotti</h2>
                <p>Contenuto dei prodotti...</p>
            </div>
            <div id="reservations" class="panel">
                <h2><i class="fas fa-calendar-alt"></i> Prenotazioni</h2>
                <p>Contenuto delle prenotazioni...</p>
            </div>
        </div>
    </div>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
