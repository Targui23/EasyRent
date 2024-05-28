<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/include/connect.php";


    if(isset($_GET['id']) && $_GET['id'] > 0){

        $sql2="SELECT *
            FROM device as d
            JOIN have as h ON d.Device_model_id = h.Device_model_id
            JOIN device_characteristics as dc ON h.Characteristics_id = dc.Characteristics_id
            WHERE d.Device_id = :Device_id";

            $stmt2 = $db->prepare($sql2);
            

            $stmt2->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
                    
            $stmt2->execute();

            $rows = $stmt2->fetchAll();

            $caratteristiche  = [];

            foreach ($rows as  $row) {
                $caratteristiche[] = [
                    'Characteristics_name' => $row['Characteristics_name'],
                    'Size' => $row['Size']
                ];
            
                // var_dump($caratteristiche);
                // exit;
            }




            





















        $sql = "SELECT *
                    FROM device AS d
                    JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
                    JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id
                    WHERE d.Device_id = :Device_id";

        $stmt = $db->prepare($sql);
        

        $stmt->bindParam(':Device_id', $_GET['id'], PDO::PARAM_INT);
        
        $stmt->execute();

        $records = $stmt->fetchAll();

        
        

        // 

            // $sql2="SELECT *
            // FROM have as h 
            // WHERE d.Device_model_id = :Device_model_id";

            // $stmt2 = $db->prepare($sql2);
            

            // $stmt2->bindParam(':Device_model_id', $_GET['Device_model_id'], PDO::PARAM_INT);
                    
            // $stmt->execute();

            // $rows = $stmt->fetchAll();

           
            
      
            
    }
    

        

        
        


        


        
    

    

                
    


    // echo var_dump($records);

?>


<body>
    
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="fiche_product">
        <?php if(isset($records) && !empty($records)) { ?>
            <?php foreach($records as $devices){ ?>
            <div>
                <div id="cardCategorie">
                    <a href=""></a>
                    <div class="image">
                        <img src="<?=  htmlspecialchars ($devices ['Device_image']); ?>" alt="" style="wight: 100px; height: 100px;">
                    </div>
                    <div>
                        <p><?=  htmlspecialchars ($devices ['Device_brand_name']); ?></p>
                        <p><?=  htmlspecialchars ($devices ['Device_model_name']); ?></p>
                        <h2><?=  htmlspecialchars ($devices ['Device_priceRent']); ?>€</h2>
                        <p><?=  htmlspecialchars ($devices ['Device_description']); ?></p>
                        <p><?=  htmlspecialchars ($devices ['Device_status']); ?></p>

                    </div>
                </div>
            </div>
            <?php } ?>
            <?php foreach($caratteristiche as $key => $value){ ?>
                <p><?php htmlspecialchars ($value ['Characteristics_name']);?></p>
                <p><?php htmlspecialchars ($value ['Size']);?></p>
                <?php var_dump($value); ?>
                <?php exit; ?>

            <?php } ?>
            
        <?php } ?>

    

</body>


</body>
<footer>
    <?php require __ROOT__ .'/public/components/footer.php'; ?>
</footer>