<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['id']) && $_GET['id'] > 0){
    
        $sql = "SELECT * FROM device WHERE Device_id = :Device_id";
        $stmt = $db->prepare($sql);
        

        $stmt->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
        
        $stmt->execute();
    
        $row = $stmt->fetchAll();


        $sql2 = "SELECT db.Device_brand_name
                    FROM device AS d
                    JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
                    JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id
                    WHERE d.Device_id = :Device_id";

        $stmt = $db->prepare($sql2);
        

        $stmt->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
        
        $stmt->execute();
    
        $records = $stmt->fetchAll();
    }



    // echo var_dump($row);

?>


<body>
    
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="fiche_product">
        <?php if(isset($row) && !empty($row)) { ?>
            <?php foreach($row as $device){ ?>
            <div>
                <div id="cardCategorie">
                    <a href=""></a>
                    <div class="image">
                        <img src="<?=  htmlspecialchars ($device ['Device_image']); ?>" alt="" style="wight: 100px; height: 100px;">
                    </div>
                    <div>
                        <h3><?=  htmlspecialchars ($device ['Device_name']); ?></h3>
                        <?php foreach($records as $devicebrand){ ?>
                            <p><?=  htmlspecialchars ($devicebrand ['Device_brand_name']); ?></p>
                        <?php } ?>
                        <h2><?=  htmlspecialchars ($device ['Device_priceRent']); ?>€</h2>
                        <p><?=  htmlspecialchars ($device ['Device_description']); ?></p>
                        <p><?=  htmlspecialchars ($device ['Device_description']); ?></p>
                        <p><?=  htmlspecialchars ($device ['Device_status']); ?></p>
                        

                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } else { ?>
            <p>Nessun prodotto trovato</p>
        <?php } ?>

    

</body>


</body>
<footer>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
</footer>