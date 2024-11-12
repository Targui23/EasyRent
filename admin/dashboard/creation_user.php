<?php


    define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
    require __ROOT__ . "/admin/include/connect.php";

    session_start();

    // Verifica se l'amministratore è autenticato
    if (!isset($_SESSION['user_id'])) {
        die("Accesso non autorizzato.");
    }

    if (isset($_POST['firstName']) && $_POST['firstName'] !== '' &&
        isset($_POST['lastName']) && $_POST['lastName'] !== '' &&
        isset($_POST['email']) && $_POST['email'] !== '' &&
        isset($_POST['password']) && $_POST['password'] !== '' &&
        isset($_POST['image']) && $_POST['image'] !== '' &&
        isset($_POST['address']) && $_POST['address'] !== '' &&
        isset($_POST['zipCode']) && $_POST['zipCode'] !== '' &&
        isset($_POST['phoneNum']) && $_POST['phoneNum'] !== '' &&
        isset($_POST['authorisationId']) && $_POST['authorisationId'] !== '') {

        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

       $sql = "INSERT INTO customer (Customer_firstName, Customer_lastName, Customer_email, Customer_password, Customer_image, Customer_adress, Customer_zipCode, Customer_phoneNum, Authorisation_id) 
                VALUES (:firstName, :lastName, :email, :password, :image, :address, :zipCode, :phoneNum, :authorisationId)";


        
        $stmt = $db->prepare($sql);


        $stmt->bindParam(':firstName', $_POST['firstName'], PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $_POST['lastName'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':image', $_POST['image'], PDO::PARAM_STR);
        $stmt->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
        $stmt->bindParam(':zipCode', $_POST['zipCode'], PDO::PARAM_STR);
        $stmt->bindParam(':phoneNum', $_POST['phoneNum'], PDO::PARAM_INT);
        $stmt->bindParam(':authorisationId', $_POST['authorisationId'], PDO::PARAM_STR);

        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: /admin/dashboard/dashboard_admin.php?status=success"); // Ridireziona alla dashboard
            exit();
        } else {
            header("Location: /admin/dashboard/dashboard_admin.php?status=error"); // Ridireziona comunque alla dashboard
            exit();
        }


    }else {
            header("Location: /admin/dashboard/dashboard_admin.php?status=error"); // Ridireziona comunque alla dashboard
            exit();
    }




    