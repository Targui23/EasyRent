<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['id']) && $_GET['id'] > 0){
        $sql = "SELECT *
                    FROM device AS d
                    JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
                    JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id
                    JOIN have as h ON dm.Device_model_id = h.Device_model_id 
                    JOIN device_characteristics AS dc ON h.Characteristics_id = dc.Characteristics_id
                    WHERE d.Device_id = :Device_id";

        $stmt = $db->prepare($sql);
        

        $stmt->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
        
        $stmt->execute();
    
        $records = $stmt->fetchAll();
        


        $sql2 = "SELECT *
                    FROM device AS d
                    JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
                    JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id
                    JOIN have as h ON dm.Device_model_id = h.Device_model_id 
                    JOIN device_characteristics AS dc ON h.Characteristics_id = dc.Characteristics_id
                    WHERE d.Device_id = :Device_id";

        $stmt2 = $db->prepare($sql2);
        

        $stmt2->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
        
        $stmt2->execute();
    
        $row = $stmt2->fetchAll();

        var_dump($row);
        exit;
        


        
    

    }

                
    


    // echo var_dump($records);

?>


<body>
    
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="fiche_product">
        <?php if(isset($records) && !empty($records)) { ?>
            <?php foreach($records as $devicebrand){ ?>
            <div>
                <div id="cardCategorie">
                    <a href=""></a>
                    <div class="image">
                        <img src="<?=  htmlspecialchars ($devicebrand ['Device_image']); ?>" alt="" style="wight: 100px; height: 100px;">
                    </div>
                    <div>
                        
                            <p><?=  htmlspecialchars ($devicebrand ['Device_brand_name']); ?></p>
                            <p><?=  htmlspecialchars ($devicebrand ['Device_model_name']); ?></p>
                    
                        <h2><?=  htmlspecialchars ($devicebrand ['Device_priceRent']); ?>€</h2>
                        <p><?=  htmlspecialchars ($devicebrand ['Device_description']); ?></p>
                        <p><?=  htmlspecialchars ($devicebrand ['Device_status']); ?></p>
                        <?php foreach($devicebrand as $cara){ ?>
                        <p><?=  htmlspecialchars ($cara ['Characteristics_name']); ?></p>
                        <p><?=  htmlspecialchars ($cara ['Size']); ?></p>
                        <?php } ?>
                        
                        

                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?><

    

</body>


</body>
<footer>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
</footer>