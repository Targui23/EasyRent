
<?php
  define('__ROOT__', $_SERVER['DOCUMENT_ROOT']);
  require __ROOT__ . "/admin/include/connect.php";

  if (isset($_POST['email']) && isset($_POST['password'])){ 
        $sql="SELECT * FROM customer WHERE Customer_email=:email";
        $stmt= $db -> prepare($sql);
        $stmt->execute ([":email" => $_POST['email']]);
            if ($row = $stmt -> fetch()){
                if (password_verify($_POST['password'], $row['Customer_password'])){
                    session_start([
                        'cookie_lifetime' => 3600, // Durée du cookie de session en secondes (1 heure)
                    ]);
                    $_SESSION['user_connected']="ok";
                    $_SESSION['user_id']=$row['Customer_id'];
                    $_SESSION['token']= md5(random_int(0,100000).date("ymdhis"));
                    $_SESSION['last_activity'] = time();

                    $update_sql = "UPDATE customer SET Costumer_token = :token WHERE Customer_id = :id";
                    $update_stmt = $db->prepare($update_sql);
                    $update_stmt->execute([
                        ':token' => $_SESSION['token'],
                        ':id' => $row['Customer_id']
                    ]);

                    header("Location: /admin/dashboard/dashboard_admin.php");
                    exit();
                } 
            }
    }

// if (isset($_POST['email']) && isset($_POST['password'])) {
//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     // Recherchez l'utilisateur dans la table customer
//     $sql = "SELECT * FROM customer WHERE Customer_email = :email";
//     $stmt = $db ->prepare($sql);
//     $stmt->execute([':email' => $email]);
//     $row = $stmt->fetch();
//             //  var_dump($row);        

//     if ($row && password_verify($password, $row['Customer_password'])) {
//         // var_dump($row);

//         // L'utilisateur existe, vérifiez s'il est administrateur
//         if ($row['Admin_booleen'] == true) {

//             // L'utilisateur est un administrateur
//             session_start(); // Démarre une session pour l'utilisateur connecté

//             // Crée des variables de session qui maintiennent l'état de la connexion de l'utilisateur et appliquent des contrôles d'accès basés sur le rôle et l'autorisation de l'utilisateur dans d'autres parties de l'application.
//             $_SESSION['user_connected'] = "ok"; // Indique que l'utilisateur est connecté
//             $_SESSION["user_id"] = $row['Customer_id']; // Stocke l'ID de l'utilisateur

//         // Vérifiez si l'utilisateur est un administrateur
//             if ($row['Admin_booleen'] == true && $row['Authorisation_id'] == 1 ) {
                
//                 // L'utilisateur est un administrateur
//                 $_SESSION["role"] = 'admin'; // Indique que l'utilisateur est un administrateur
//                 $_SESSION["authorization"] = 'admin'; // Aucune autorisation spécifique pour les administrateurs
                
                
//                 // Redirigez vers le tableau de bord de l'administrateur
//                 header("Location:/../admin/cc/xcx.php");            
//                 exit();
//             } else {

//                 // L'utilisateur est un client
//                 $_SESSION["role"] = 'customer'; // Indique que l'utilisateur est un client

//                 $_SESSION["authorization"] = $row['Authorisation_id']; // Stocke l'autorisation spécifique du client
                
//                 // Redirigez vers le tableau de bord du client
//                 header("Location:/../dashboardUser/dashboardUser.php"); 
//                 exit();

                
//             }
//         } else {
//             echo "Email ou mot de passe incorrect.";
//             exit();
//         }
// }
// ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./logincss/login.css">


</head>

<body>  
    <!-- En-tête -->
    <!-- Formulaire de connexion inclus dans views/admin/login.php et views/customer/login.php. -->

    <div class="login">   
        <img class="img_login" src="/img/logo.png" alt="" srcset="">
        
        <form method="post" action="" class="login_form">
            <h1>Bienvenue ! Connectez-vous</h1>
            <div class="login_email">
                <label for="email">Saisissez l'adresse e-mail :</label>                    
                <input type="email" name="email">
                <!-- Les attributs "id" des champs de saisie correspondent aux attributs "for" des balises <label>. Cela garantit une meilleure accessibilité et une expérience utilisateur améliorée lors de la sélection des champs à l'aide des étiquettes -->
                <span></span>
                
            </div>

            <div class="login_pass">
                <label>Mot de Passe:</label>
                <input type="password" name="password">
                <div class="affiche_pass">
                    <input type="checkbox" id="checkbox" name="affiche_pass">
                    <p>Afficher le mot de passe</p>
                </div>
                
            </div>
            
            <input id="login-button" class="column-6" name="submit" type="Submit" value="Login">
            
        </form>
    </div>

    <!-- Formulaire de Connexion (views/partials/login_form.php) : Ce fichier contient le formulaire HTML. Le rôle (admin ou customer) est passé en tant que champ caché. -->
</body>
</html>
