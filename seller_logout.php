<?php 
    session_start();
    unset($_SESSION["seller"]);
    session_destroy($_SESSION["seller"]);

    header('location:seller_login.php');
    //exit();
?>