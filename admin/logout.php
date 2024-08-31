<?php
    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

    session_start();


    // Supprime le jetons dans la base de données si l'utilisateur est connecté
    if (isset($_SESSION['user_id'])) {
        $logout_sql = "UPDATE customer SET Costumer_token = NULL WHERE Customer_id = :id";
        $logout_stmt = $db->prepare($logout_sql);
        $logout_stmt->execute([
            ':id' => $_SESSION['user_id']
        ]);
    }

    // Vide toutes les variables de session
    $_SESSION = array();

    // Détruit la session
    session_destroy();

    // Supprime le cookie de la session
    setcookie(session_name(), '', time() - 3600, '/');

    // Vérifie si $_SESSION est vide
    if (empty($_SESSION)) {
        echo "La session a été détruite correctement.";
        header("Location: /../public/index.php");
        exit(); // Assurez-vous que le script s'arrête ici
    } else {
        echo "La session n'a pas été détruite correctement.";
    }

?>