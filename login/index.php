<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">    
    <title>Login</title>
</head>
<body>

  <!-- Nav tabs -->
  <div class="header">
    <div class="nav_bar"> 
      <h2 class="h2_logo-noir" >Easy</h2>
        <a class="nav_link" href="index.php">
          <img src="../img/logosansmarque-removebg-preview.png" alt="" class="logo_img">
        </a>
      <h2 class="h2_logo-orange" >Rent</h2>
      
  <!-- 
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="login.php">Login</a></li>
      <li><a href="register.php">Register</a></li>
    </ul> -->
    </div>
  </div>


<div class="row">
  <!-- <div class="column-3 menu">
    <ul>
    <li>The Flight</li>
    <li>The City</li>
    <li>The Island</li>
    <li>The Food</li>
    </ul>
  </div> -->

  <div class="column-7">
    <img class="img_login" src="../img/kedibone-isaac-makhumisane-BprwjNPX2Vk-unsplash.jpg" alt="" srcset="">
  </div>

  <div class="column-4 right">

    <div class="aside">      
    <form class="" method="POST">
        <div class="txt_field"> 
          <h3>Connexion</h3>
          <br>
            <input type="text" name="text" required>
            <label>Saisissez une adresse e-mail</label>
        </div>
        
        <div class="txt_field">
            <input type="password" name="password" required>
            <span></span>
            <label>Mot de Passe</label>
        </div>
       
        <input id="submit" class="column-6" name="submit" type="Submit" value="Login">
       
        <div  class="signup_link">
        <span></span>
          <label>Vous n'arrivez pas à vous connecter?</label>
          <a href="contact.php">Inscription</a>
        </div>

        <div class="signup_link">
          <span></span>
          <label>Inscrivez-vous à un compte </label>
          <a href="signup.php">Inscription</a>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="footer">
  <p> Mahammed Leïla @Copyright </p>
</div>
    
</body>
</html>