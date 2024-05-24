<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";

    
    $sql = "SELECT * FROM device_category";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $subCategories = array();

    
    $sql2 = "SELECT ds.Device_SubCategory_Name, ds.Device_SubCategory_id
        FROM Device_subcategory ds  
        INNER JOIN Device_Category dc ON ds.Device_category_id = dc.Device_category_id
        WHERE ds.Device_category_id = :Device_category_id";

    $stmt2 = $db->prepare($sql2);

    
    foreach ($categories as $category) {
        $category_id = $category['Device_category_id'];
        
       
        $stmt2->bindParam(':Device_category_id', $category_id, PDO::PARAM_INT);
        $stmt2->execute();
        
        
        $subCategories[$category_id] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }
?>

<link rel="stylesheet" href="../css/cataloguestyle.css">

<?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="titlepage">
        <h1>Explorez notre Catalogue.</h1>
        <h2>"Découvrez notre large gamme de catégories 
            une sélection variée d'options conçues pour répondre à une multitude de besoins dans le domaine de l'informatique."</h2>
    </section>
    <hr class="line">
    <section class="categorie_cards">
        <?php foreach($categories as $category){ ?>
            <h2><?=  htmlspecialchars ($category['Device_category_name']); ?></h2>
            <div class="cards">
                
                <?php foreach($subCategories[$category['Device_category_id']] as $subCategory){ ?>
                    <div id="cardCategorie">
                        <div class="image"></div>
                        <a href="liste_produits.php?id=<?= $subCategory['Device_SubCategory_id']; ?>">
                        <h3><?= htmlspecialchars($subCategory['Device_SubCategory_Name']); ?>
                        
                        
                    </div>
                <?php } ?>
            </div>
            <hr class="line">
        <?php } ?> 
    </section>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
