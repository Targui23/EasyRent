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
                <select name="select" class="select">
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
        <img src="/img/photo_accueil/happyclient.jpg" alt="happy client " style="width : 500px; height: 300px; ">
    </div>
    <div class="who_we_are">
        <img src="/img/photo_accueil/who_we_are.jpg" alt="happy client " style="width : 400px; height: 250px; ">
        <span>
            <h2>Qui sommes-nous</h2>
            <h3>Easy Rent : 
                votre référence depuis 2010 pour accéder au meilleur de la technologie sans barrières. 
                Nous sommes une équipe de passionnés, engagés à transformer la manière dont vous vivez et travaillez 
                avec les dispositifs électroniques. Qu'il s'agisse d'ordinateurs, de smartphones, de tablettes ou de 
                périphériques avancés, notre mission est de démocratiser l'accès aux technologies les plus récentes 
                avec des solutions de location flexibles et accessibles. Nous ne voulons pas seulement vous fournir 
                un produit, mais vous offrir une expérience extraordinaire, vous permettant d'explorer, d'innover et 
                de grandir sans limitations.
            </h3>
        </span>
    </div>
    <div class="our_offer">
        <span>
            <h2>Notre offre</h2>
            <h3>
                Imaginez un monde où la technologie n'a pas de frontières, 
                où vous pouvez toujours avoir à votre disposition le dispositif 
                adéquat pour vos besoins, sans le poids des coûts initiaux exorbitants. 
                Easy Rent rend tout cela possible avec une gamme incroyable de produits, 
                des ordinateurs portables puissants pour le travail créatif aux tablettes 
                pour l'apprentissage et la communication. Notre offre ne se limite pas à 
                vous fournir les outils les plus avancés, mais comprend également un service 
                client d'excellence et un support technique constant. Chaque solution que nous
                proposons est conçue pour être flexible et personnalisable, afin que vous puissiez 
                vous concentrer sur ce qui compte vraiment, pendant que nous nous occupons du reste.
                Avec Easy Rent, la technologie devient un allié sans compromis.
            </h3>
        </span>
        <img src="/img/photo_accueil/equipement_informatique" alt="happy client " style="width : 300px; height: 400px; ">
       
    </div>
    <div class="our_mission">
        <img src="/img/photo_accueil/mission" alt="happy client " style="width : 500px; height: 300px; ">
        <span>
            <h2>Notre mission</h2>
            <h3>Chez Easy Rent, notre engagement va au-delà de l'offre de technologies de pointe. Nous sommes profondément convaincus que l'avenir 
                de la planète dépend des choix que nous faisons aujourd'hui. C'est pourquoi nous nous engageons activement dans des initiatives de 
                durabilité environnementale, telles que le recyclage et la réduction des déchets électroniques, prolongeant ainsi la durée de vie des 
                dispositifs. Nous collaborons avec des partenaires écologiques pour assurer que nos produits soient éliminés de manière responsable et
                durable. Mais notre engagement ne s'arrête pas là : nous soutenons également des initiatives sociales pour réduire la fracture numérique,
                en faisant don de matériel reconditionné aux écoles et aux communautés défavorisées. Nous sommes convaincus que chaque location avec Easy Rent 
                est un pas vers un monde plus équitable et durable. Avec notre approche basée sur la transparence et la responsabilité, nous travaillons pour 
                garantir un impact positif à long terme, tant pour nos clients que pour l'environnement. Rejoignez-nous et faites partie d'une communauté qui croit 
                en la technologie comme une force motrice pour un changement positif.
            </h3>
        </span>
    </div>
    <div class="our_work">
        <span>
            <h2>Notre travail</h2>
            <h4>Chez Easy Rent, notre façon de travailler est orientée vers la recherche constante de la meilleure solution pour nos clients, 
                en trouvant le parfait équilibre entre prix et qualité. Nous sommes conscients que chaque besoin est unique et c'est pourquoi
                nous nous engageons à offrir des propositions personnalisées qui répondent aux nécessités spécifiques de chaque client. Grâce
                à une analyse attentive et une sélection rigoureuse des produits, nous garantissons des dispositifs technologiques à la pointe 
                de la technologie à des tarifs compétitifs, sans compromis sur la qualité. Notre philosophie repose sur l'écoute et la collaboration 
                : nous travaillons en étroite collaboration avec nos clients pour comprendre leurs réels besoins et fournir des solutions qui améliorent 
                leur expérience technologique. Nous visons l'excellence non seulement dans les produits, mais aussi dans le service, en assurant une assistance
                dédiée et un support continu pour rendre la location une expérience simple et satisfaisante. Avec Easy Rent, vous avez un partenaire qui travaille 
                à vos côtés pour vous offrir toujours le meilleur.
            </h4>
        </span>
        <img src="/img/photo_accueil/our_work" alt="happy client " style="width : 500px; height: 300px; ">
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
        <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2611.940963818931!2d6.173874175429574!3d49.106761983197124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4794dd50b1aeb723%3A0x3f41549215e3dc57!2sMetz%20Numeric%20School!5e0!3m2!1sfr!2sfr!4v1718788919623!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
            <h2>Contact</h2>
            <p>13 Rue des Clercs<br>57000 Metz, France <br>easyrent@info.com <br>(+33) 06-33-23-78-99  </p>
            <p>57000 Metz, France</p>
            <p>easyrent@info.com</p>
            
            <p>(+33) 06-33-23-78-99</p>
        </div>
        
    </div>


    </div>

    
      


</section>






</body>
<footer>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
</footer>

<script src="/Js/indexjs.js"></script>