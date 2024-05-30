<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['SC_id']) && $_GET['SC_id'] > 0){

        
    
      $sql = "SELECT d.Device_id, dm.Device_model_name, d.Device_id, d.Device_image, d.Device_priceRent, d.Device_model_id
            FROM device as d 
            INNER JOIN device_model as dm ON d.Device_model_id = dm.Device_model_id
            WHERE d.device_subCategory_id = :Device_subCategory_id";
    
    // Prepara la dichiarazione
    $stmt = $db->prepare($sql);

    // Associa il parametro
    $stmt->bindParam(':Device_subCategory_id', $_GET['SC_id'], PDO::PARAM_INT);

    // Esegui la query
    $stmt->execute();

    // Recupera i risultati
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // var_dump($rows);
    // exit;
   

    }

    

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
        <?php if(isset($rows) && !empty($rows)) { ?>
            <?php foreach($rows as $device){ ?>
                <div id="cardCategorie">
                    <a href="product.php?dm_id=<?= $device['Device_model_id']; ?>">
                    <div class="image">
                        <img src="<?=  htmlspecialchars ($device ['Device_image']); ?>" alt="" style="wight: 100px; height: 100px;">
                    </div>
                    <div>
                        <h3><?=  htmlspecialchars ($device ['Device_model_name']); ?></h3>
                        <h2><?=  htmlspecialchars ($device ['Device_priceRent']); ?>€</h2>
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