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

// Préparez la requête
$sql = "UPDATE customer SET 
    Customer_lastName = :lastName,
    Customer_firstName = :firstName,
    Customer_email = :email,
    Customer_adress = :address,
    Customer_zipCode = :zipCode,
    Customer_phoneNum = :phoneNum
    WHERE Customer_id = :customer_id";

$stmt = $db->prepare($sql);

// Exécutez la requête avec les données du formulaire
$stmt->execute([
    ':lastName' => isset($_POST['lastName']) ? trim($_POST['lastName']) : '',
    ':firstName' => isset($_POST['firstName']) ? trim($_POST['firstName']) : '',
    ':email' => isset($_POST['email']) ? trim($_POST['email']) : '',
    ':address' => isset($_POST['address']) ? trim($_POST['address']) : '',
    ':zipCode' => isset($_POST['zipCode']) ? trim($_POST['zipCode']) : '',
    ':phoneNum' => isset($_POST['phoneNum']) ? trim($_POST['phoneNum']) : '',
    ':customer_id' => $user_id
]);

// Vérifiez si au moins un enregistrement a été mis à jour
    if ($stmt->rowCount() >= 0) {
        header("Location: /admin/dashboard/dashboard_admin.php?status=success"); // Redirigez vers le tableau de bord
        exit();
    } else {
        header("Location: /admin/dashboard/dashboard_admin.php?status=error"); // Redirigez tout de même vers le tableau de bord
        exit();
    }   
} die("ID utilisateur non fourni.");

// $user_id = $_POST['customer_id']; // ID de l'utilisateur à mettre à jour

// // Préparez la requête
// $sql = "UPDATE customer SET 
//     Customer_lastName = :lastName,
//     Customer_firstName = :firstName,
//     Customer_email = :email,
//     Customer_adress = :address,
//     Customer_zipCode = :zipCode,
//     Customer_phoneNum = :phoneNum
//     WHERE Customer_id = :customer_id";

// $stmt = $db->prepare($sql);

// // Exécutez la requête avec les données du formulaire
// $stmt->execute([
//     ':lastName' => isset($_POST['lastName']) ? trim($_POST['lastName']) : '',
//     ':firstName' => isset($_POST['firstName']) ? trim($_POST['firstName']) : '',
//     ':email' => isset($_POST['email']) ? trim($_POST['email']) : '',
//     ':address' => isset($_POST['address']) ? trim($_POST['address']) : '',
//     ':zipCode' => isset($_POST['zipCode']) ? trim($_POST['zipCode']) : '',
//     ':phoneNum' => isset($_POST['phoneNum']) ? trim($_POST['phoneNum']) : '',
//     ':customer_id' => $user_id
// ]);

// // Vérifiez si au moins un enregistrement a été mis à jour
// if ($stmt->rowCount() > 0) {
//     header("Location: /admin/dashboard/dashboard_admin.php"); // Redirigez vers le tableau de bord
//     exit();
// } else {
//     header("Location: /admin/ciao.php"); // Redirigez tout de même vers le tableau de bord
//     exit();
// }

?>
