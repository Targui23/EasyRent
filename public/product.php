<?php
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require __ROOT__ . "/admin/include/connect.php";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRent</title>
    <link rel="stylesheet" href="../css/productstyle.css">
    <link href="/assets/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
</head>

<body>
    <?php require __ROOT__ .'/public/components/header.php'; ?>
    <section class="fiche_product">
        <?php if(isset($records) && !empty($records)) { ?>
            <?php foreach($records as $devices){ ?>
            <div class="product_topside">
                <div id="cardCategorie">
                    <a href=""></a>
                    <div class="image">
                        <img src="<?= htmlspecialchars($devices['Device_image']); ?>" alt="photo of product" >
                    </div>
                    <div class="product_left_side">
                        <h2><?= htmlspecialchars($devices['Device_brand_name']); ?> <?= htmlspecialchars($devices['Device_model_name']); ?></h2>
                        <h2><?= htmlspecialchars($devices['Device_priceRent']); ?>€/mois</h2>
                        <h2>status : <?= htmlspecialchars($devices['Device_status']); ?></h2>
                        <div class="product_service">
                            <span>
                                <i class="fa-solid fa-umbrella"></i>
                                <p>Couverture d'assurance incluse</p>
                            </span>
                            <span>
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <p>Durée de location flexible</p>
                            </span>
                            <span>
                                <i class="fa-solid fa-building"></i>
                                <p>Retrait uniquement sur site</p>
                            </span>
                        </div>
                        <?php 
                            if(isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == 'ok'){
                        ?>
                                <div class="invitation-container">
                                    <h3>Ne manquez pas cette opportunité !</h3>
                                    <p>Louer dès maintenant!</p>
                                </div>
                                <div class="open-modal-div" data-product-id="<?php echo htmlspecialchars($_GET['dm_id']); ?>" 
                                data-user-id="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">Louer le produit </div>
                               
                                <div class="modal" id="bookingModal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <h2>Réservez ce produit</h2>
                                        <p>Produit ID: <span id="modalProductId"></span></p>
                                        <p>user  ID: <span id="modalUserId"></span></p>
                                        <form id="bookingForm" method="POST" action="process_booking.php">
                                            <label for="start_reservation">Sélectionnez la date de réservation</label>
                                            <input type="date" id="start_reservation" name="start_reservation" required>
                                            <label for="end_reservation">Sélectionnez la date de fine de réservation:</label>
                                            <input type="date" id="end_reservation" name="end_reservation" required>
                                           
                                            <input type="hidden" class="result" id="result" name="product_id" value='<div class="result" id="result"></div>'>
                                            <input type="hidden" id="product_id" name="product_id" value="<?php echo htmlspecialchars($_GET['dm_id']); ?>">
                                            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                                            <button type="submit">Réservez</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Copertura sfondo modale -->
                                <div class="modal-overlay"></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="product_description">
                <h3>Description</h3>
                <p><?= htmlspecialchars($devices['Device_description']); ?></p>
            </div>
            <div>
                <h3>Caractéristiques</h3>
                <?php if(isset($row) && !empty($row)) { ?>
                    <table class="carateristic_tablle" style="border: solid black 1px">
                        <thead>
                            <tr>
                                <th>Nom de la Caractéristique</th>
                                <th>Taille</th>
                            </tr>
                        </thead>
                        <tbody style="border: solid black 1px">
                            <?php foreach($row as $char) { ?>
                                <tr style="border: solid black 1px">
                                    <td style="border: solid black 1px"><?= htmlspecialchars($char['Characteristics_name']); ?></td>
                                    <td style="border: solid black 1px"><?= htmlspecialchars($char['Size']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
    <footer>
        <?php require __ROOT__ .'/public/components/footer.php'; ?>
    </footer>
</body>
<script src="../js/headerjs.js"></script>
<script src="../js/modal_reservation.js"></script>
</html>
