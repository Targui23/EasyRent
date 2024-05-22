<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['id']) && $_GET['id'] > 0){
    
    $sql = "SELECT * FROM device WHERE Device_category_id = :Device_category_id";
    $stmt = $db->prepare($sql);
    
    
    $stmt->bindParam(':Device_category_id', $_GET['id'], PDO::PARAM_INT);
    
    
    $stmt->execute();
    
    
    $row = $stmt->fetchAll();
}

    // echo var_dump($row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cataloguestyle.css">
    <title>Document</title>
</head>
<body>
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="categorie_cards">
        <?php if(isset($row) && !empty($row)) { ?>
            <?php foreach($row as $device){ ?>
            <div>
                <div id="cardCategorie">
                    <div class="image">
                        <img src="<?=  htmlspecialchars ($device ['Device_image']); ?>" alt="" style="wight: 100px; height: 100px;">
                    </div>
                    <div>
                        <h3><?=  htmlspecialchars ($device ['Device_name']); ?></h3>
                        <h2><?=  htmlspecialchars ($device ['Device_priceRent']); ?>€</h2>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <p>Nessun prodotto trovato</p>
        <?php } ?>
    </section>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
    

</body>
</html>