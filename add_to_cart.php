<?php
    session_start();
   

    include_once "includes/connection.php";
    //include_once "includes/sweet_alerts.php";
    if(!isset($_SESSION["customer"]["id"])){
        $_SESSION["redirectURL"] = ($_SERVER['REQUEST_URI']);
        //echo  $_SESSION["redirectURL"];
        header("Location:login.php");
    }
    else{
        $flag = 0;
        $pid = $_POST['PID'];
        $quantity = $_POST["p_quantity"];
        $cid = $_SESSION["customer"]["id"];
        //echo $quantity;
        
        $items_in_stock = 0;

        //checking if user request items more then availabels in stock
        $sql = "SELECT *FROM product WHERE PID = '$pid'";
        $res = $conn->query($sql);
        if($res->num_rows > 0){
            while($data = $res->fetch_assoc()){
                $items_in_stock = $data["product_quantity"];
            }
        }


        if($quantity > $items_in_stock){
           // echo "error";
            echo "Only $items_in_stock items available in stock.";
            die;
        }
        else {
            // if item already in cart then update previus item no need to insert again
            $sql = "SELECT *FROM cart WHERE pid = '$pid' AND cid = '$cid'";
            $res = $conn->query($sql);
            if($res->num_rows > 0){
            while($data  = $res->fetch_assoc()){
                    $temp_product_id = $data["pid"];
                    if($temp_product_id == $pid) {
                        $present_quantity = $data["quantity"];

                        $present_quantity += $quantity;
                        $sql = "UPDATE cart SET quantity = '$present_quantity' WHERE pid = '$pid' AND cid = '$cid'";
                        if($conn->query($sql) === true){
                            echo "Product added in cart";
                            $flag = 1;
                        }
                        else{
                           // echo "Error in item updation";
                        }
                    }
                }
            }

            if($flag == 0){
            
                $sql = "INSERT INTO cart VALUES('$pid', '$cid', '$quantity')";
                if($conn->query($sql) === true){
                    echo "Product added in cart";
                }
                else{
                   // echo "Error";
                }
            }

            // getting current items stock; 
            $sql = "SELECT *FROM product WHERE PID = $pid";
            $res = $conn->query($sql);
            if($res->num_rows > 0) {
                while($data = $res->fetch_assoc()){
                    $current_quantity = $data["product_quantity"];
                }
            }

            //updating items stock
            $new_quantity = $current_quantity - $quantity;

            //if quantity is 0 zero then delete item or hide it
            /*if($new_quantity == 0){
                
            } else*/
            $sql = "UPDATE product SET product_quantity = '$new_quantity' WHERE PID = '$pid'";
            if($conn->query($sql) === true){
              //  echo "Product added in cart";
            }
            else{
              //  echo "Error in quantity updation";
            }


            
        // header("Location:search_item.php");
        }
    }
?>