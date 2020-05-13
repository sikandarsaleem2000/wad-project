<!<!DOCTYPE html>
<html>
    <head>
        <title>Shoopers | All Customers</title>
        <?php
            session_start();
            include_once "includes/connection.php";
            include_once "includes/links.php";
           // include_once "includes/header.php";
            include_once "includes/sweet_alerts.php";
            $cid = $_SESSION["customer"]["id"];
            $name = $_SESSION["customer"]["name"];
            $counter = $flag = 0;
        ?>
    </head> 
    <body>
    <div class="container-fluid animation">
			<div class="row pb-3" style="background:#e6e6e6">
				<div class="container"><br>
				<p><a href="index.php">Home </a> /  Order History</p>
				</div>
			</div>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr> 
                        <th><b>Sr.</b></th>                 
                        <th><b>Customer Name</b></th>
                        <th><b>Purchased Items</b></th>
                        <th><b>Quantity</b></th>
                        <!-- <th>Delete</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT *FROM order_history WHERE cid = '$cid'";
                        $res = $conn->query($sql);
                        if($res->num_rows > 0):
                            while($cols = $res->fetch_assoc()):
                                $counter++;
                                $pid  = $cols["pid"];
                               // $quantity = $cols["product_quantity"];
                                //$price = $cols["product_price"];
                                //$added_date = $cols["date"];
                                $quantity = $cols["quantity"];
                                
                                $query = "SELECT *FROM product WHERE PID = '$pid'";
                                $rows = $conn->query($query);
                                if($rows->num_rows > 0):
                                    while($col = $rows->fetch_assoc()):
                                        $product_name = $col["product_name"];
                                        $flag = 1;

                                
                    ?>
                                            <tr>
                                                <td><?php echo $counter?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $product_name?></td>
                                                <td><?php echo $quantity?></td>
                                              
                                              
                                                <!-- <td><button class="btn btn-danger">Remove</button></td> -->
                                            </tr>

                 <?php               endwhile;
                                endif;
                            endwhile;
                        endif;        
                    ?>
                </tbody>
            </table>
            <?php
                if($flag == 0){
                    echo "<p class='display-4'>This customer not buy anything</p>";
                }
            ?>
		</div>
    <body>
</html>
<?php include_once "includes/footer.php"?>