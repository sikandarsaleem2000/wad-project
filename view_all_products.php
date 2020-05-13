<!DOCTYPE html>
<html>
    <head>
        <title>Shoopers | All Customers</title>
        <?php
            include_once "includes/links.php";
            include_once "includes/connection.php";
            $counter = 0;
        ?>
    </head> 
    <body>
        <div class="container-fluid animation">
			<div class="row pb-3" style="background:#e6e6e6">
				<div class="container"><br>
				<p><a href="index.php">Home</a><a href="admin.php"> / Admin Panel</a> /  View all products</p>
				</div>
			</div>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr> 
                        <th><b>Sr.</b></th>                 
                        <th><b>Title</b></th>
                        <th><b>Quantity</b></th>
                        <th><b>Price</b></th>
                        <th><b>Added Date</b></th>
                        <th><b>Posted By</b></th>
                        <!-- <th>Delete</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT *FROM product";
                        $res = $conn->query($sql);
                        if($res->num_rows > 0):
                            while($cols = $res->fetch_assoc()):
                                $counter++;
                                $name  = $cols["product_name"];
                                $quantity = $cols["product_quantity"];
                                $price = $cols["product_price"];
                                $added_date = $cols["date"];
                                $sid = $cols["seller_id"];
                                
                                $query = "SELECT *FROM seller WHERE SID = '$sid'";
                                $rows = $conn->query($query);
                                if($rows->num_rows > 0):
                                    while($col = $rows->fetch_assoc()):
                                        $seller_name = $col["seller_shop_name"];

                                
                    ?>
                                            <tr>
                                                <td><?php echo $counter?></td>
                                                <td><?php echo $name?></td>
                                                <td><?php echo $quantity?></td>
                                                <td><?php echo $price?></td>
                                                <td><?php echo $added_date?></td>
                                                <td><?php echo $seller_name." Store"?></td>
                                                <!-- <td><button class="btn btn-danger">Remove</button></td> -->
                                            </tr>

                 <?php               endwhile;
                                endif;
                            endwhile;
                        endif;        
                    ?>
                </tbody>
            </table>
		</div>
    </body>
</html>
<?php include_once "includes/footer.php"?>