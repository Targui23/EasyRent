<?php

    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

    session_start();

    // Vérifiez si l'administrateur est authentifié
    if (!isset($_SESSION['user_id'])) {
        die("Accès non autorisé.");
    }

    // var_dump($_POST);

    // Vérifiez si l'ID de l'utilisateur a été transmis
    if (isset($_POST['customer_id']) && $_POST['customer_id'] !== '') {
        $user_id = $_POST['customer_id']; // ID de l'utilisateur à mettre à jour

        // var_dump($user_id);
        // exit(); 

        $sql="DELETE FROM customer WHERE Customer_id = :customer_id ";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':customer_id', $_POST['customer_id'], PDO::PARAM_INT);
        $stmt->execute();
    }

?>
