<?php
    session_start();
    include_once "includes/connection.php";
    $pid = $_POST["pid"];
    $quantity = $_POST["quantity"];
    //echo $pid;
    //echo $quantity;
    $cid = $_SESSION["customer"]["id"];

    // updating product quantity if he remove items from cart
    $sql = "SELECT *FROM product WHERE pid = '$pid';";
    $res = $conn->query($sql);
    if($res->num_rows > 0){
        while($data = $res->fetch_assoc()){
            $current_quantity = $data["product_quantity"];
            $new_quantity = $current_quantity + $quantity;
            $sql = "UPDATE product SET product_quantity = '$new_quantity' WHERE  pid = '$pid'";
            if($conn->query($sql) === true){
                echo "Quantity Updated";
            }
            else{
                echo "Error in quantity updation";
            }
        }
    }

    $sql = "DELETE FROM cart WHERE pid = '$pid' AND cid = '$cid'";
    if($conn->query($sql) === true){
        echo "Product deleted";
    }
    else{
        echo "Error in deletion";
    }

?>