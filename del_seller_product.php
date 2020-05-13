<?php
    session_start();
    include_once "includes/connection.php";
    if(!isset($_SESSION["seller"]["id"])){
        header ("Location : seller_login.php");
    }
    else {
        $pid = $_POST['pid'];
        echo "Product ID is ".$pid."<br>";
        $sql = "DELETE FROM cart WHERE pid = '$pid'";
        
        $conn->query($sql);

        $sql = "SELECT *FROM comments WHERE pid = '$pid'";
        $conn->query($sql);
        
        $sql = "DELETE FROM product WHERE PID = '$pid'";
        if($conn->query($sql) === true){
            echo "product deleted successfully";
        }
        else{
            echo "error";
        }
    }
?>