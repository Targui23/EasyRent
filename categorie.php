<?php
    $num_sezioni = 5;
    $nom_categorie= [
        "CATÉGORIES DANS ORDINATEUR", 
        "CATÉGORIES DANS TÉLÉPHONE & TABLETTE", 
        "CATÉGORIES DANS PÉRIPHÉRIQUE PC",
        "CATÉGORIES DANS RÉSEAUX", 
        "CATÉGORIES DANS CONNECTIQUE", 
        "CATÉGORIES DANS IMAGE & SON",
    ]

    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="/css/categoriestyle.css">
   
</head>
<body>
    <header class="mainheader">
        <img src="/img/logoo.png" alt="logo header" class="logoheader" style="width: 90px; height: 90px; margin-left:10px;">
        <nav>
            <ul>
                <li>Accueil</li>
                <li>Catalogue</li>
                <li>Nos services</li>
                <li>A propos</li>
                <li>Contact</li>
            </ul>
        </nav>
        <button class="headerbutton">Connexion</button>
    </header>
    <section class="titlepage">
        <h1>Explorez notre Catalogue.</h1>
        <h2>"Découvrez notre large gamme de catégories 
            une sélection variée d'options conçues pour répondre à une multitude de besoins dans le domaine de l'informatique."</h2>
        <div class="catordi">
            <h2>Ordinateur Dekstops et Laptop</h2>
            <h3></h3>
        </div>

    </section>
    <hr class="line">
    <?php for ($i = 0; $i < $num_sezioni; $i++) : ?>
        <section>
            <?php foreach ($nom_categorie as $title_categorie) : ?>
            <?php if (!$titolo_visualizzato) : ?>
                <h2><?php echo $title_categorie; ?></h2>
                <?php $titolo_visualizzato = true; ?>
            <?php endif; ?>
            <!-- Qui inserisci il resto del codice HTML per la sezione -->
        <?php endforeach; ?>
            <div class="cards">
                <?php for ($j = 0; $j < 4; $j++) : ?>
                    <div id="cardcategorie">
                        <div class="image"></div>
                        <h3>lql</h3>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
    <hr class="line">
    <?php endfor; ?>

</body>
</html>