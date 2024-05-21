<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";

    $sql = "SELECT * FROM device_category";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll();
    
    
    
    
    

?>


<link rel="stylesheet" href="../css/categoriestyle.css">

<?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="titlepage">
        <h1>Explorez notre Catalogue.</h1>
        <h2>"Découvrez notre large gamme de catégories 
            une sélection variée d'options conçues pour répondre à une multitude de besoins dans le domaine de l'informatique."</h2>
    </section>
    <hr class="line">
    <section class="categorie_cards">
        <?php foreach($row as $title_categorie){ ?>
            <h2><?=  htmlspecialchars ($title_categorie ['Device_category_name']); ?></h2>
            <div class="cards">
            <?php for ($j = 0; $j < 4; $j++) { ?>
                <div id="cardCategorie">
                    <div class="image"></div>
                        <h3>lql</h3>
                    </div>
            <?php } ?>
                </div>
            <hr class="line">
        <?php } ?> 
    </section>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>

    



