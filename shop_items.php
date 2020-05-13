<script src="js/main.js"></script>
<script src="jQuery/jQuery.js"></script>

<?php
    error_reporting(0);
    session_start();
    $flag = 0;
    $counter = 0;
    if(!$_SESSION["customer"]["email"]){
        header("Location:login.php");
    }
    else{
        include_once "includes/connection.php";
        include_once "includes/links.php";
        include_once "includes/header.php";
    //session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SHOP &mdash; Shoopers</title>
    </head>

    <body >

        <div class="container bg-light mt-5">
            <div class="row">
                <?php
                    $price = 0; 
                    $sql = "SELECT *FROM product";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0):
                        $flag  = 1;
                        while($data = $res->fetch_assoc()):
                            $pid = $data["PID"];
                            $title = $data["product_name"];
                            $price = $data["product_price"];
                            $short_intro = $data["product_short_intro"];
                            $img_path = $data["product_img"];
                            $quantity = $data["product_quantity"];

                            if($quantity > 0){
                                $counter++;
                ?>
                            <div class="col-lg-3 p-3 item-box">
                                <img class="thumbnail" src="<?php echo $img_path; ?>" width="100%" height="210px">
                                <b><?php echo $title;?></b>
                                <br><small><?php echo $short_intro; ?></small><br>
                                <small>on limited stock</small><br>
                                <span style="color:orange;font-weight:bold">RS. <?php echo $price?></span><br>
                                <a href="product_description.php?pid=<?php echo $pid; ?>" style="color:white;"><button class="btn btn-primary btn-block view_btn"><i style="font-size:22px" class="fa fa-eye"></i> View </button></a>
                               
                            </div>      
                <?php
                            }
                        endwhile;
                    endif;
                   if($flag == 0)
                        echo "<p class='display-4 p-3'>No Item Found</p>";
                    
                ?>

            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {

            // designing 
            
            $(".item-box").hover(function(){
                $(this).addClass("shadow");
                $(this).css("background-color","#e6e6e6");
            }, function(){      
                //$(this).(".shop_btn").hide();
                $(this).removeClass("shadow");
                $(this).css("background-color","");
            });
        });
    </script>
</html>
<?php
    include_once "includes/footer.php";
    }
?>