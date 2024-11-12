<?php 
    try {
        $db = new PDO("mysql:host=localhost;dbname=easyrent;charset=utf8", "root", "");
    }catch(PDOException $e){ 
        die("Error of BDD");
    }


?>