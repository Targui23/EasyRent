<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";

    $sql="SELECT * FROM device_category";

    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    


    $sql_products ="SELECT  d.Device_image, dm.device_model_name, db.device_brand_name, d.Device_priceRent
                FROM device AS d
                INNER JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
                INNER JOIN device_brand AS db ON db.Device_brand_id = db.Device_brand_id
                ORDER BY RAND()
                LIMIT 4"; // Puoi modificare il numero di prodotti visualizzati modificando il valore di LIMIT

// Prepara e esegui la query per i prodotti casuali
    $stmt_products = $db->prepare($sql_products);
    $stmt_products->execute();
    $random_products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

    // Debug: Visualizza i prodotti casuali
    var_dump($random_products);

    


    require __ROOT__ .'/public/components/header.php'; 




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/css/indexstyle.css">
    <link href="/assets/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    
   
</head>



<body>
    <section id="hero">
      <h2 class="titlehero">"Parce que louer n'a jamais été aussi facile."</h2>
      <div class="buttons">
        <a class="button" href="#contact">contact us</a>
        <a class="button" href="#contact">contact us</a>
      </div>
    </section> 
    <section class="punchline">
        <div class="punchlinet">
            <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo fugiat</h2>
        </div>
        <div class="punchlinep">
            <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt soluta fugiat,</h3>
        </div>
        <div></div>
    </section> 
    <section>
        <div class="recherche">
            <div class="categori">
                <select name="select" id="" class="select">
                    <?php foreach ($categories as $category){ ?>
                    <option value="pcfix"><?=  htmlspecialchars ($category['Device_category_name']); ?></option>
                    <?php } ?>
                </select>
            </div>
                <div>
                    <input type="search" class="input">
                    <input type="submit" class="enter"></input>
                </div>
        </div>
    </section>
    <hr class="line">
    <section class="popular">
        <div>
            <h2 class="populartitle">Popular de la semaine</h2>
        </div>
        <?php foreach($random_products as $random_product) { ?>
        <div class="cards">
            <div id="card">
                <div class="image">
                    <img src="<?=  htmlspecialchars ($random_product['Device_image']); ?>" alt="" style="width: 100px; height: 100px;">
                </div>
                <h2><?=  htmlspecialchars ($random_product['device_brand_name']); ?></h2>
                <h3><?=  htmlspecialchars ($random_product['device_model_name']); ?></h2>
                <h3><?=  htmlspecialchars ($random_product['Device_priceRent']); ?></h3>
            </div>
            <?php } ?>
        </div>


    </section>
    <hr class="line">
    <section class="brands">
        <div class="bandstitle">
            <h2>Les brands chez nous</h2>

        </div>
        <div class="logobrands">
            <img src="../img/apple.png" alt="">
            <img src="../img/apple.png" alt="">
            <img src="../img/apple.png" alt="">
            <img src="../img/apple.png" alt="">
        </div>

    </section>
    <hr class="line">
    <section id="services">
        <div class="servicestitle"> 
            <h2>Nos services</h2>
            <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex ullam alias hic iste officiis</h3>
        </div>
        <div class="process">
            <div class="iconprocess">
                <img src="../img/user.png" alt="" class="icon">
            </div>
            <hr>
            <div class="iconprocess">
                <img src="../img/user.png" alt="" class="icon">
            </div>
            <hr>
            <div class="iconprocess">
                <img src="../img/user.png" alt="" class="icon">
            </div>
            <hr>
            <div class="iconprocess">
                <img src="../img/user.png" alt="" class="icon">
            </div>
            <hr>
            <div class="iconprocess">
                <img src="../img/user.png" alt="" class="icon">
            </div>

        </div>
    
    </section>
    <hr class="line">
    <section id="about">
        <div class="firstcontainer">
            <div class="abouttext">
                <h2>Who we are?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore molestiae, 
                    officiis quam quisquam maiores velit nobis dolores, magnam corrupti laborum 
                    reiciendis maxime rem est cumque voluptatum nemo quo architecto harum.
                </p>
            </div>
            <div class="aboutimage">
                <img src="../img/logo.png" alt="">
            </div>
        </div>
        <div class="secondcontainer">
            <div class="aboutimage">
            </div>
            <div class="abouttext">
                <h2>Who we are?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore molestiae, 
                    officiis quam quisquam maiores velit nobis dolores, magnam corrupti laborum 
                    reiciendis maxime rem est cumque voluptatum nemo quo architecto harum.
                </p>
            </div>
        </div>
    </section> 
    <hr class="line">
    <?php require __ROOT__ .'/public/components/footer.php'; ?>

