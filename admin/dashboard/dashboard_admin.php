<?php

    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

    session_start();

    if (isset($_SESSION['user_id']) && (isset($_SESSION['user_connected']) && $_SESSION['user_connected'] == 'ok')){
        $user_id = $_SESSION['user_id'];
        // var_dump( $user_id);
        // exit();
        
    
        $sql = "SELECT * FROM customer WHERE Customer_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($rows);
        // exit();

        $sql2 = "SELECT *
            FROM device AS d
            JOIN device_model AS dm ON d.Device_model_id = dm.Device_model_id
            JOIN device_brand AS db ON dm.Device_brand_id = db.Device_brand_id";

        $stmt = $db->prepare($sql2);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $role = '';
        foreach($rows as $row){ 
            if ($row['Authorisation_id'] == 1) {
                $role = 'Amministratore';
            } elseif ($row['Authorisation_id'] == 2) {
                $role = 'Elite User';
            } elseif ($row['Authorisation_id'] == 3) {
                $role = 'User';
            }
        }

        $sql3="SELECT * FROM customer";
        $stmt= $db -> prepare($sql3);
        $stmt -> execute();
        $users= $stmt ->fetchAll(PDO::FETCH_ASSOC);

        $sql4="SELECT * , 
        dm.device_model_name, c.customer_id
        FROM reservation AS r
        JOIN device_model AS dm ON r.device_model_id = dm.device_model_id
        JOIN customer AS c ON r.customer_id = c.customer_id" ;
        $stmt= $db -> prepare($sql4);
        $stmt-> execute();
        $reservations = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        

    }

    
   





?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../dashboard_css/dashboard.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <!-- Font Awesome Icons -->
    
</head>
<body>
    <?php require __ROOT__ .'/public/components/header.php'; ?>

    <div class="dashboard">
        <div class="sidebar_dash">
            <h2>Dashboard</h2>
            <ul>
            <?php foreach($rows as $row){ ?>
                <li><a href="#profile"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> parametres</a></li>
                <?php if($row['Admin_booleen'] == 1){ ?>
                    <li><a href="#users"><i class="fas fa-users"></i>Utilisateur</a></li>
                    <li><a href="#products"><i class="fas fa-box"></i> Product</a></li>
                <?php } ?>
                <li><a href="#reservations"><i class="fas fa-calendar-alt"></i> Reservation</a></li>

            <?php } ?>
            </ul>
        </div>
        <div class="main">
            <div id="profile" class="panel">
                <h2><i class="fas fa-user"></i> Information sur le Profile connecté</h2>
                <?php if(isset($rows) && !empty($rows)) { ?>
                    <?php foreach($rows as $row){ ?>
                        <p><strong>Prenom:</strong> <?= htmlspecialchars($row['Customer_firstName']); ?></p>
                        <p><strong>Nom:</strong> <?= htmlspecialchars($row['Customer_lastName']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($row['Customer_email']); ?></p>
                        <p><strong>adresse:</strong> <?= htmlspecialchars($row['Customer_adress']); ?>, <?= htmlspecialchars($row['Customer_zipCode']); ?></p>
                        <p><strong>Numero de telephone:</strong> <?= htmlspecialchars($row['Customer_phoneNum']); ?></p>
                        <p><strong>Role:</strong> <?= htmlspecialchars($role); ?></p>
                    <?php } ?>
                <?php } ?>

                <div id="successBanner" class="banner">Opération réussie!</div>
                <div id="errorBanner" class="banner" style="background-color: red;">Une erreur est survenue !</div>
            </div>
            <div id="settings" class="panel">
                <h2><i class="fas fa-cog"></i> Paramètres</h2>
                <p></p>
            </div>
            <?php foreach($rows as $row){ ?>
                <?php if($row['Admin_booleen'] == 1){ ?>
                    <div id="users" class="panel">
                        <div class="top_panel">
                            <h2><i class="fas fa-users"></i> Comptes Utilisateurs</h2>

                            <!-- ajouter account user -->
                            <button class="add-user-btn">
                                <i class="fas fa-user-plus"></i>
                            </button>
                            

                            
                        </div>
                        <div id="addUserModal" class="modal">
                            <div class="modal-content">
                                <span class="close_form">&times;</span>
                                <h2>Ajouter un nouvel utilisateur</h2>
                                <form id="addUserForm" action="creation_user.php"  method="post" class="modif_user">
                                    <div class="form-group">
                                        <label for="firstName">Prénom</label>
                                        <input type="text" id="firstName" name="firstName" placeholder="Inserisci il nome">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName">Nom</label>
                                        <input type="text" id="lastName" name="lastName" placeholder="Inserisci il cognome">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" name="email" placeholder="Inserisci l'email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" placeholder="Inserisci la password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password_2" name="password" placeholder="Inserisci la password">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">image</label>
                                        <input type="text" id="image" name="image" placeholder="URL dell'immagine">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Adresse</label>
                                        <input type="text" id="address" name="address" placeholder="Inserisci l'indirizzo">
                                    </div>
                                    <div class="form-group">
                                        <label for="zipCode">Code postale</label>
                                        <input type="text" id="zipCode" name="zipCode" placeholder="Inserisci il CAP">
                                    </div>
                                    <div class="form-group">
                                        <label for="phoneNum">Numéro de téléphone</label>
                                        <input type="text" id="phoneNum" name="phoneNum" placeholder="Inserisci il numero di telefono">
                                    </div>
                                    <div class="form-group">
                                        <label for="authorisationId">Role</label>
                                        <select id="authorisationId" name="authorisationId">
                                            <option value="1">Amministratore</option>
                                            <option value="2">Elite User</option>
                                            <option value="3">User</option>
                                        </select>
                                    </div>
                                    <button type="submit">Enregistrer</button>
                                </form>
                            </div>
                        </div>
                        <?php foreach($users as $user) { ?>
                            <div class="user-info">
                                <p><strong> <?= htmlspecialchars($user['Customer_lastName']); ?> <?= htmlspecialchars($user['Customer_firstName']); ?> </strong></p>
                                <div class="buttons">
                                    <!-- Button Modification -->
                                    <button class="btn-edit" data-modal-id="editModal_<?= htmlspecialchars($user['Customer_id']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Button supprimer -->
                                    <button class="btn-delete" data-modal-id="deleteUserModal" data-user-id="<?= htmlspecialchars($user['Customer_id']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </div>
                            </div>

                            <!-- Modale per la Modifica -->
                            <div id="editModal_<?= htmlspecialchars($user['Customer_id']); ?>" class="modal">
                                <div class="modal-content">
                                    <span class="close" data-modal-id="editModal_<?= htmlspecialchars($user['Customer_id']); ?>">&times;</span>
                                    <h2>Modifier les informations de l'utilisateur</h2>
                                    <form id="editForm_<?= htmlspecialchars($user['Customer_id']); ?>" action="modification_user.php" method="post" class="modif_user">
                                        <input type="hidden" name="customer_id" value="<?= htmlspecialchars($user['Customer_id']); ?>">

                                        <label for="lastName">Nom :</label>
                                        <input type="text" name="lastName" value="<?= htmlspecialchars($user['Customer_lastName']); ?>">

                                        <label for="firstName">Prénom:</label>
                                        <input type="text" name="firstName" value="<?= htmlspecialchars($user['Customer_firstName']); ?>">

                                        <label for="email">Email:</label>
                                        <input type="email" name="email" value="<?= htmlspecialchars($user['Customer_email']); ?>">

                                        <label for="address">Adresse:</label>
                                        <input type="text" name="address" value="<?= htmlspecialchars($user['Customer_adress']); ?>">

                                        <label for="zipCode">Code postal:</label>
                                        <input type="text" name="zipCode" value="<?= htmlspecialchars($user['Customer_zipCode']); ?>">

                                        <label for="phoneNum">Numéro de téléphone:</label>
                                        <input type="text" name="phoneNum" value="<?= htmlspecialchars($user['Customer_phoneNum']); ?>">

                                        <button type="submit">Enregistrer les modifications</button>
                                    </form>
                                </div>
                            </div>

                            
                            <div id="deleteUserModal" class="modal-delete-user">
                                <div class="modal-content-delete-user">
                                    <span class="close" data-modal-id="deleteUserModal">&times;</span>
                                    <p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p>
                                    <form id="deleteUserForm" method="POST" action="./delete_user.php">
                                        
                                        <input type="hidden" name="user_id" id="user_id">
                                        <button type="submit" class="btn-confirm-delete-user">Confirmer</button>
                                        <button type="button"  class="btn-cancel-delete-user">Annuler</button>
                                    </form>
                                </div>
                            </div>

                        
                        <?php } ?>
                    </div>
                    <div id="products" class="panel">
                        <div class="top_panel">
                            <h2><i class="fas fa-box"></i> Produits</h2>

                            <button class="add-product-btn">
                                <i class="fas fa-box"> +</i>
                            </button>

                        </div>

                        <?php foreach($products as $product){ ?>
                            <div class="product_info">
                                <p><strong><?= htmlspecialchars($product['Device_model_name']); ?></strong></p>
                                <div class="buttons">
                                    <button class="btn-edit" >
                                        <i class="fas fa-edit"></i>
                                    </button>

                                   
                                    <button class="btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    

                                </div>
                            </div>
                        <?php } ?>


                        
                    </div>
                <?php } ?>


                <div id="reservations" class="panel">
                    <h2><i class="fas fa-calendar-alt"></i> Réservation</h2>
                    <div class="reservation_info">
                        <h3>Toutes les réservation</h3>
                        
                            
                                <?php foreach($reservations as $reservation) { ?>
                                    <?php if($reservation['Reservation_accepted'] === NULL && $reservation['Reservation_refused'] === NULL) { ?>
                                        <div class="reservation_user">
                                            <p><strong><?= htmlspecialchars($reservation['Reservation_id']); ?> -
                                            <?= htmlspecialchars($reservation['Customer_firstName']); ?> <?= htmlspecialchars($reservation['Customer_lastName']); ?></strong></p>

                                        <div class="buttons">
                                                <button class="btn_view" data-modal-id="<?= htmlspecialchars($reservation['Reservation_id']); ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Modale pour accepter/refuser la réservation -->
                                        <div class="modal reservationModal" data-reservation-id="<?= htmlspecialchars($reservation['Reservation_id']); ?>">
                                            <div class="modal-content">
                                                <span class="close-modal">&times;</span>
                                                <h2>Gestion de la Réservation</h2>

                                                <!-- Formulaire dans le modale -->
                                                <form class="reservationForm" action="reservation.php" metod="post">
                                                    <label for="reservationNote-<?= htmlspecialchars($reservation['Reservation_id']); ?>"><strong>Note sur la Réservation numero : </strong><?= htmlspecialchars($reservation['Reservation_id']); ?></label>
                                                    <label for="reservationNote-<?= htmlspecialchars($reservation['Reservation_id']); ?>"><strong>Utilisateur  : </strong><?= htmlspecialchars($reservation['Customer_firstName']); ?> <?= htmlspecialchars($reservation['Customer_lastName']); ?></label>
                                                    <label for="reservationNote-<?= htmlspecialchars($reservation['Reservation_id']); ?>"><strong>Produit  : </strong><?= htmlspecialchars($reservation['Device_model_name']); ?> </label>

                                                    <label for="reservation_startDate"><strong>Début de réservation</strong></label>
                                                    <input type="date" name="start_reservation" value="<?= htmlspecialchars($reservation['Reservation_startDate']); ?>">

                                                    <label for="reservation_startDate"><strong>Fin de réservation</strong></label>
                                                    <input type="date" name="start_reservation" value="<?= htmlspecialchars($reservation['Reservation_endDate']); ?>">

                                                    <label for="checkAvailability">Souhaitez-vous valider la reservation ?</label>
                                                     
                                                        <input type="checkbox" id="accept" name="checkAvailability" value="1" onclick="toggleCheckbox('accept')">Accepter
                                                    
                                                    
                                                        <input type="checkbox" id="refuse" name="checkAvailability" value="0" onclick="toggleCheckbox('refuse')">Refuser
                                                    

                                                    <div class="modal-buttons">
                                                        <!-- Bouton pour accepter -->
                                                        
                                                        <button type="submit" class="accept-btn" data-reservation-id="<?= htmlspecialchars($reservation['Reservation_id']); ?>">Valider</button>

                                                            <!-- Bouton pour refuser -->
                                                        
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                           
                            
                       
                    </div>

                    <div class="reservation_info">
                        <h3>Réservation refusée</h3>
                        <?php foreach($reservations as $reservation){ ?>
                            <span>
                                <?php if($reservation['Reservation_refused'] !== NULL){ ?>
                                    <p><strong><?= htmlspecialchars($reservation['Reservation_id']); ?> -
                                    <?= htmlspecialchars($reservation['Customer_firstName']); ?> <?= htmlspecialchars($reservation['Customer_lastName']); ?></strong></p>

                                <?php } ?>
                       <?php } ?>
                    </div>
                    
                    <div class="reservation_info">
                        <h3>Réservation accepted</h3>
                        <?php foreach($reservations as $reservation){ ?>
                            <span>
                                <?php if($reservation['Reservation_accepted'] !== NULL){ ?>
                                    <p><strong><?= htmlspecialchars($reservation['Reservation_id']); ?> -
                                    <?= htmlspecialchars($reservation['Customer_firstName']); ?> <?= htmlspecialchars($reservation['Customer_lastName']); ?></strong></p>

                                <?php } ?>
                       <?php } ?>
                    </div>

                    

                </div>
            <?php } ?>
        </div>
    </div>
    <script src="../dashboardJS/dashboard.js"></script>
    <script src=".../js/headerjs.js"></script>
</body>
</html>

