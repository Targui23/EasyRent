<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";


    if(isset($_GET['SC_id']) && $_GET['SC_id'] > 0){

        
    
        $sql = "SELECT d.Device_id, dm.Device_model_name, d.Device_id, d.Device_image, d.Device_priceRent, d.Device_model_id, db.Device_brand_name
                FROM device as d 
                INNER JOIN device_model as dm ON d.Device_model_id = dm.Device_model_id
                INNER JOIN device_brand as db ON dm.Device_brand_id = db.Device_brand_id
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

    // session_start();

    // if(isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == 'ok'){

    //     $user_id = $_SESSION['user_id'];
        
    //     // $sql = "SELECT c.Authorisation_id, a.Authorisation_type  
    //     //         FROM customer c
    //     //         INNER JOIN authorisation a ON c.Authorisation_id = a.Authorisation_id
    //     //         WHERE c.Customer_id = :user_id";


    //     // $stmt2 = $db->prepare($sql);

    //     // $stmt2->bindParam(':user_id', $user_id, PDO::PARAM_INT);;

    //     // // Esegui la query
    //     // $stmt2->execute();

    //     // // Recupera i risultati
    //     // $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    //     // var_dump($rows);
    //     // exit;


        
    // }
    

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/liste_product.css">
    <title>Easy rent</title>
</head>
<body>
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="categorie_cards">
        <?php if(isset($rows) && !empty($rows)) { ?>
            <?php foreach($rows as $device){ ?>
                <div id="cardCategorie">
                    <div class="device_background">
                        <a href="product.php?dm_id=<?= $device['Device_model_id']; ?>">
                        <div class="image">
                            <img src="<?=  htmlspecialchars ($device ['Device_image']); ?>" alt="" >
                        </div>
                        <div>
                            <h2><?=  htmlspecialchars ($device ['Device_brand_name']); ?> <?=  htmlspecialchars ($device ['Device_model_name']); ?></h2>
                            <h3><?=  htmlspecialchars ($device ['Device_priceRent']); ?>€</h3>
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