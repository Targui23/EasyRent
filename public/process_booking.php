<?php
define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
require __ROOT__ . "/admin/include/connect.php";

session_start();

// Fonction pour valider le format de la date
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

// Vérifie si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifie que toutes les données nécessaires sont présentes et valides
    if (
        isset($_POST['product_id']) && 
        isset($_POST['user_id']) &&
        isset($_POST['start_reservation']) &&
        isset($_POST['end_reservation'])
    ) {
        $device_model_id = $_POST['product_id'];
        $customer_id = $_POST['user_id'];
        $start_reservation = $_POST['start_reservation'];
        $end_reservation = $_POST['end_reservation'];
        $reservation_received = 1; 

        // Vérifie si la connexion à la base de données est établie
        if (!$db) {
            $error = "Erreur de connexion à la base de données.";
        } elseif (!validateDate($start_reservation) || !validateDate($end_reservation)) {
            $error = 'Le format de la date est invalide.';
        } elseif ($start_reservation > $end_reservation) {
            $error = 'La date de début de la réservation ne peut pas être ultérieure à la date de fin de la réservation.';
        } else {
            try {
                // Insertion des données dans la base de données
                $sql = "INSERT INTO reservation (Reservation_startDate, Reservation_endDate, Reservation_created, Customer_id, Device_model_id) 
                        VALUES (:start_reservation, :end_reservation, CURDATE(), :customer_id, :device_model_id)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':start_reservation', $start_reservation, PDO::PARAM_STR);
                $stmt->bindParam(':end_reservation', $end_reservation, PDO::PARAM_STR);
                $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_STR);
                $stmt->bindParam(':device_model_id', $device_model_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    header('Location:/public/product.php?dm_id=' . $device_model_id);
                    exit;
                } else {
                    $error = 'Erreur lors de l\'insertion de la réservation. Veuillez réessayer.';
                }
            } catch (PDOException $e) {
                $error = 'Erreur de base de données : ' . htmlspecialchars($e->getMessage());
            }
        }
    } else {
        $error = 'Données manquantes ou invalides dans la requête. Veuillez vérifier et réessayer.';
    }
} else {
    $error = 'Méthode de requête non valide.';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de la Réservation</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php else: ?>
        <p>La réservation a été effectuée avec succès !</p>
    <?php endif; ?>
</body>
</html>
