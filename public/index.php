<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

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
    

    $directory = '../img/brands_logo';

    $files = scandir($directory);

    $validExtensions = ['jpg', 'jpeg', 'png', 'gif']; 
    $images = array_filter($files, function($file) use ($directory, $validExtensions) {
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return in_array(strtolower($extension), $validExtensions) && is_file("$directory/$file");
    });

    

    


    require __ROOT__ .'/public/components/header.php'; 




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRent</title>
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
            <h2>"La technologie que vous voulez, quand vous la voulez. Sans compromis."</h2>
        </div>
        <div class="punchlinep">
            <h3>Louez aujourd'hui, innovez demain.</h3>
        </div>
        <div></div>
    </section> 
    <section>
        <div class="recherche">
            <div class="categori">
                <select name="select" class="select">
                    <?php foreach ($categories as $category){ ?>
                    <option value="pcfix"><?=  htmlspecialchars ($category['Device_category_name']); ?></option>
                    <?php } ?>
                </select>
            </div>
                <div class="input">
                    <input type="search" class="input">
                </div>
                <div class="button">
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
            <div id="single_card">
                <div class="image">
                    <img src="<?=  htmlspecialchars ($random_product['Device_image']); ?>" alt="" >
                </div>
                <div class="name_product">
                    <h2><?=  htmlspecialchars ($random_product['device_brand_name']); ?></h2>
                    <h3><?=  htmlspecialchars ($random_product['device_model_name']); ?></h2>
                
                    <h3><?=  htmlspecialchars ($random_product['Device_priceRent']); ?></h3>
                </div>
            </div>
            <?php } ?>
        </div>


    </section>
    <hr class="line">
    <section class="brands">
        <div class="bandstitle">
            <h2>Les brands chez nous</h2>

        </div>
        
        <div class="scroller" data-direction="right  ">
             <div class="scroller_inner">
                <?php foreach($images as $image) { ?>
                    
                    <img src="../img/brands_logo/<?= $image ?>" alt="" >
                    
               <?php }
                    ?>
                
            </div>
        </div>

    </section>
    <hr class="line">
    <section id="services">
        <div class="servicestitle"> 
            <h2>Nos services</h2>
            <h3>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex ullam alias hic iste officiis</h3>
        </div>
        <div class="container">
            <div class="steps">
                <span class="circle active">
                    1
                </span>
                <span class="circle">
                    2
                </span>
                <span class="circle">
                    3
                </span>
                <span class="circle">
                    4
                </span>
                <span class="circle">
                    5
                </span>
                <div class="progress-bar">
                    <span class="indicator">

                    </span>
                </div>
            </div>
            <div class="buttons">
                <button id="prev" >Prev</button>
                <button id="next">Next</button>
            </div>

        </div>
    
    </section>
    <hr class="line">
<section id="about_us">
    <div class="punch_line">
        <span>
            <h2>"Easy Rent,</h2>
            <h3> où la qualité de service se traduit par une expérience impeccable et satisfaisante dans la location de produits informatiques."</h3>
        </span>
        <img src="/img/photo_accueil/happyclient.jpg" alt="happy client " loading="lazy" >
    </div>
    <div class="who_we_are">
        <img src="/img/photo_accueil/who_we_are.jpg" alt="happy client " loading="lazy" >
        <span>
            <h2>Qui sommes-nous</h2>
            <h3>Easy Rent : 
                Depuis 2010, Easy Rent facilite l'accès à la technologie en offrant des solutions
                 de location flexibles pour ordinateurs, smartphones, tablettes et périphériques. 
                 Notre mission est de vous fournir bien plus qu'un produit : une expérience unique 
                 pour innover et grandir sans limites.
            </h3>
        </span>
    </div>
    <div class="our_offer">
        <span>
            <h2>Notre offre</h2>
            <h3>
                Imaginez un monde où la technologie est accessible sans contraintes. Easy Rent propose 
                une large gamme de produits adaptés à vos besoins, sans coûts initiaux. Profitez d'outils 
                avancés, d'un service client exceptionnel et d'un support continu. Nos solutions flexibles 
                vous permettent de vous concentrer sur l'essentiel. Easy Rent, votre allié technologique.
            </h3>
        </span>
        <img src="/img/photo_accueil/equipement_informatique" alt="happy client " loading="lazy">
       
    </div>
    <div class="our_mission">
        <img src="/img/photo_accueil/mission" alt="happy client " loading="lazy">
        <span>
            <h2>Notre mission</h2>
            <h4>Chez Easy Rent, nous allons au-delà de la technologie en adoptant des pratiques durables. 
                Nous recyclons, réduisons les déchets électroniques et prolongeons la vie des dispositifs. 
                En partenariat avec des acteurs écologiques, nous éliminons les produits de manière responsable 
                et offrons du matériel reconditionné aux écoles et communautés défavorisées. Chaque location avec
                 Easy Rent contribue à un monde plus équitable et durable.
            </h4>
        </span>
    </div>
    <div class="our_work">
        <span>
            <h2>Notre travail</h2>
            <h4>Chez Easy Rent, nous allons au-delà de la technologie. Engagés pour un avenir durable,
                 nous recyclons, réduisons les déchets électroniques et prolongeons la vie des dispositifs. 
                 Avec des partenaires écologiques, nous éliminons les produits de manière responsable et offrons 
                 du matériel reconditionné aux écoles et communautés défavorisées. Chaque location avec Easy Rent 
                 soutient un monde plus durable et équitable.
            </h4>
        </span>
        <img class=""src="/img/photo_accueil/our_work" alt="happy client " loading="lazy" >
    </div>
</section>
<hr class="line">
<section id="contact_us">
    <div class="hero_contact">
        <h2 class="titlehero">"Besoin d'aide ? Notre équipe est à votre disposition."</h2>
    </div>
    <div class="contact_form">
        <h2>Contactez-nous</h2>
        <form class="form" action="#" method="post">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="telephone">Numéro de Téléphone:</label>
                <input type="tel" id="telephone" name="telephone" required pattern="[0-9]{10}">
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>
     <div class="line-with-text-container">
        <span>
           ou venez nous rendre visite
        </span>
    </div>
    <div class="contact_location">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2611.940963818931!2d6.173874175429574!3d49.106761983197124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4794dd50b1aeb723%3A0x3f41549215e3dc57!2sMetz%20Numeric%20School!5e0!3m2!1sfr!2sfr!4v1718788919623!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="info">
            <h2>Contact</h2>
            <p>13 Rue des Clercs<br>57000 Metz, France <br>easyrent@info.com <br>(+33) 06-33-23-78-99  </p>
            <p>57000 Metz, France</p>
            <p>easyrent@info.com</p>
            
            <p>(+33) 06-33-23-78-99</p>
        </div>
        
    </div>


</section>






</body>
<footer>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
</footer>

<script src="/Js/indexjs.js"></script>