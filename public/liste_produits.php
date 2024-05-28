<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['id']) && $_GET['id'] > 0){

        
    
      $sql = "SELECT device.Device_id, device_model.Device_model_name, device.Device_id, device.Device_image,device.Device_priceRent
            FROM device
            INNER JOIN device_model ON device.Device_model_id = device_model.Device_model_id
            WHERE device.device_subCategory_id = :Device_subCategory_id";
    
    // Prepara la dichiarazione
    $stmt = $db->prepare($sql);

    // Associa il parametro
    $stmt->bindParam(':Device_subCategory_id', $_GET['id'], PDO::PARAM_INT);

    // Esegui la query
    $stmt->execute();

    // Recupera i risultati
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    var_dump($rows);
   

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
                    <a href="product.php?id=<?= $device['Device_id']; ?>">
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