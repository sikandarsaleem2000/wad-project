<!DOCTYPE html>
<html>
    <head>
        <title>Shoopers | All Customers</title>
        <?php
            include_once "includes/links.php";
            include_once "includes/connection.php";
            $name = $email = $joining_date = "";
            $counter = 0;
        ?>
    </head> 
    <body>
        <div class="container-fluid animation">
			<div class="row pb-3" style="background:#e6e6e6">
				<div class="container"><br>
				<p><a href="index.php">Home</a><a href="admin.php"> / Admin Panel</a> /  View all customers</p>
				</div>
			</div>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr> 
                        <th><b>Sr.</b></th>                 
                        <th><b>Name</b></th>
                        <th><b>Email</b></th>
                        <th><b>Joining Date</b></th>
                        <!-- <th>Delete</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT *FROM signup";
                        $res = $conn->query($sql);
                        if($res->num_rows > 0):
                            while($cols = $res->fetch_assoc()):
                                $name  = $cols["customer_name"];
                                $email = $cols["customer_email"];
                                $joining_date = $cols["customer_signup_time"];
                                ///$cid = $cols["CID"];
                                $counter++;
                    ?>
                    <tr>
                        <td><?php echo $counter?></td>
                        <td><?php echo $name?></td>
                        <td><?php echo $email?></td>
                        <td><?php echo $joining_date?></td>
                        <!-- <td><button class="btn btn-danger">Remove</button></td> -->
                    </tr>

                    <?php
                            endwhile;
                        endif;        
                    ?>
                </tbody>
            </table>
		</div>
    </body>
</html>
<?php include_once "includes/footer.php"?>