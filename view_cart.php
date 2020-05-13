<?php
   // static $pids = array();
    //static $product_arr = array();
    error_reporting(0);
    session_start();
    if(!isset($_SESSION["customer"]["id"])){
        $_SESSION["redirectURL"] = ($_SERVER['REQUEST_URI']);
        header("Location:login.php");
    }
    else{

        
        include_once "includes/connection.php";
        include_once "includes/links.php";
        include_once "includes/header.php";
        include_once "includes/sweet_alerts.php";
        $cid = $_SESSION["customer"]["id"];
       
        //declaring variables
        $total_cart_item =  $pid =  0;
        $product_title = $product_img_addr = $product_price = $product_id = "";
        
        $name = $phone_no = $address;
        $name_err = $phone_no_err = $address_err;
        $error = false;
    

         
    }
        
        // this query just to get number of fav items
        $test_query = "SELECT *FROM cart WHERE cid = '$cid'";
        $temp = $conn->query($test_query);
        $total_cart_item  = $temp->num_rows;   
           
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Shoppers &mdash; Cart</title>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
<body>
    <!--<div class="container-fluid animation">
        <div class="row pb-3 bg-light">
            <div class="container"><br>
                <p><a href="index.php" class="my-auto">Home</a> / Favorites</p>
            </div>
        </div>
	</div> -->

    <div class="container-fluid p-5">
        <p class="display-4">Items in cart : <?php echo $total_cart_item?></p>
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12" style="border-right:1px solid grey">
                <table class="table table-striped">
                    <thead>
                        <tr class="font-weight-bold">
                            <th>Product</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    <thead>
                    <tbody>
                        <?php   
                            $sql = "SELECT *FROM cart WHERE cid = '$cid'";
                            $total_bill = 0;
                            $res = $conn->query($sql);
                            if ($res->num_rows > 0):						
                                while($data = $res->fetch_assoc()):
                                    $pid =  $data["pid"]; // getting data from favorite tabel  
                                    $quantity = $data["quantity"]; 
                                    $query = "SELECT *FROM product WHERE PID = '$pid'";
                                    $result = $conn->query($query);
                                    if($result->num_rows > 0) :
                                        while($row = $result->fetch_assoc()) :
                                            $product_title = $row["product_name"];
                                            $product_price = $row["product_price"];
                                            $img_address   = $row["product_img"]; 
                                        
                                            $total_bill += $quantity * $product_price; 
                                    
                                endwhile;
                            endif;
                        ?>
                        <tr>
                            <td><img src="<?php echo $img_address;?>" width="140" height="100"/></td>
                            <td style="font-size:25px;"><br><?php echo $product_title?></td>
                            <td><br><br><?php echo $product_price?></td>
                            <td><br><br><?php echo $quantity;?></td>
                            <td><button quantity = "<?php echo $quantity?>" pid = "<?php echo $pid;?>" class="btn btn-danger mt-5 del_btn " name="del_btn"><i class="fa fa-trash-alt"></i> Remove</button></td>
                            <!-- <td><a href="del_cart_item.php?pid=<?php //echo $pid; ?>" style="color:white;"><button class="btn btn-danger mt-5 del_btn"><i class="far fa-trash-alt"></i> Remove </button></a></td> -->
                        </tr>   
                        <?php
                                endwhile;
                            endif;
                        ?>
                    </tbody>
                </table>
                <br>
                <hr>
                <h3 class="font-weight-normal text-center text-primary">Total Bill Rs. <small><?php echo $total_bill;?></small></h3>
            </div>
           
            <div class="col-lg-4">
              <form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label><small>Enter Name</small></label><small style="color:red"> * <?php echo $name_err;?></small>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name " required>
                    
                    <label class="mt-3"><small>Enter Phone NO</small></label><small style="color:red"> * <?php echo $phone_no_err;?></small>
                    <input type="number" maxlength="12"class="form-control" name="phone_no" id="phoneNO" placeholder="Enter Phone Number" required>
                    
                    <label class="mt-3"><small>Enter Shipping Address</small></label><small style="color:red"> * <?php echo $address_err;?></small>
                    <input type="text" class="form-control" address="name" id="address" placeholder="Enter Shipping Address" required>

                    <center><button  name="checkout_btn" class="btn btn-info mt-3 btn-lg"><small>CHECKOUT</small></button></center>
                    
                </form>
            </div>
            
        </div>
           
    </div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('.del_btn').click(function(){
            var productID  =  $(this).attr("pid");
            var productQuantity = $(this).attr("quantity");

            $(this).attr("disabled", true);
            $(this).text("Removed");
           
            $.post(
                'del_cart_item.php',
                {
                    pid : productID,
                    quantity : productQuantity
                },
                function(status){
                    console.log(status);
                }
            );
        });

      //  $("checkout_btn").click("function")
    });
</script>
</body>

<?php
    include_once "includes/footer.php";    
    //echo $quantity;

    if(isset($_POST["checkout_btn"])){
        $flag = 0;
        if($total_bill > 0 ) {
            //clearing cart

            $sql = "INSERT INTO order_history(pid, cid, quantity) SELECT *FROM cart WHERE cid = '$cid'";
            if($conn->query($sql) === true){
                echo "inserted";
            }
            $sql = "DELETE FROM cart where cid ='$cid'";
            if($conn->query($sql) == true){
                header("Location:view_cart.php");
            }
            else{
                echo "Error";
            }

            echo "
            <script>
                swal({
                    title: 'Thank You for Shopping!',
                    text: 'You will be informed in 1 - 7 working days!',
                    icon: 'success',
                    dangerMode: false,
            })
            .then((willSuccess) => {
                if (willSuccess) {
                    window.location.href='view_cart.php';
                }
            });
            </script>";
        }
     
     
     
     
        else if($flag == 0  && $total_bill == 0){
            echo "<script>Swal.fire(
                'Cart is empty',
                'Shoopers',
                'error'
            )
            </script>";
        }
       
    }
    
?>
