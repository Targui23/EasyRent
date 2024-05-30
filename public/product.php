<?php
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require __ROOT__ . "/include/connect.php";

if(isset($_GET['dm_id']) && $_GET['dm_id'] > 0){
   
    $sql = "SELECT *
            FROM device AS d
            JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
            JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id
            WHERE d.Device_model_id = :Device_model_id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Device_model_id', $_GET['dm_id'], PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT h.Size, dc.Characteristics_name
             FROM have as h
             JOIN device_model as dm ON h.Device_model_id = dm.Device_model_id
             JOIN device_characteristics as dc ON h.Characteristics_id = dc.Characteristics_id
             WHERE h.Device_model_id = :Device_model_id";

    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':Device_model_id', $_GET['dm_id'], PDO::PARAM_INT);
    $stmt2->execute();
    $row = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
}


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
                        <img src="<?= htmlspecialchars($devices['Device_image']); ?>" alt="" style="width: 100px; height: 100px;">
                    </div>
                    <div>
                        <p><?= htmlspecialchars($devices['Device_brand_name']); ?></p>
                        <p><?= htmlspecialchars($devices['Device_model_name']); ?></p>
                        <h2><?= htmlspecialchars($devices['Device_priceRent']); ?>€</h2>
                        <p><?= htmlspecialchars($devices['Device_description']); ?></p>
                        <p><?= htmlspecialchars($devices['Device_status']); ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div>
                <h3>Caractéristiques</h3>
                <?php if(isset($row) && !empty($row)) { ?>
                    <?php foreach($row as $char) { ?>
                        <p><?= htmlspecialchars($char['Characteristics_name']); ?>: <?= htmlspecialchars($char['Size']); ?></p>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
    <footer>
        <?php require __ROOT__ .'/public/components/footer.php'; ?>
    </footer>
</body>
