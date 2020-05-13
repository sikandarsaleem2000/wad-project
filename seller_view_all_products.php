<script src="js/main.js"></script>
<script src="jQuery/jQuery.js"></script>

<?php
    error_reporting(0);
    session_start();
    $flag = 0;
    if(!$_SESSION["seller"]["id"]){
        header("Location:login.php");
    }
    else{
        include_once "includes/connection.php";
        include_once "includes/links.php";
        include_once "includes/header.php";
        $sid = $_SESSION["seller"]["id"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View All Products &mdash; Shoopers</title>
    </head>

    <body >

        <div class="container bg-light mt-5">
            <div class="row">
                <?php 
                    $sql = "SELECT *FROM product WHERE seller_id = $sid ORDER BY date DESC";
                    $res = $conn->query($sql);
                    if($res->num_rows > 0):
                        $flag  = 1;
                        while($data = $res->fetch_assoc()):
                            $pid = $data["PID"];
                            $title = $data["product_name"];
                            $price = $data["product_price"];
                            $short_intro = $data["product_short_intro"];
                            $img_path = $data["product_img"];
                            ///echo $img_path;
                ?>
                            <div class="col-lg-3 p-3 item-box <?php echo " ".$pid;?>">
                                <img class="thumbnail" src="<?php echo $img_path; ?>" width="100%" height="210px">
                                <b><?php echo $title;?></b>
                                <br><small><?php echo $short_intro; ?></small><br>
                                <small>on limited stock</small><br>
                                <span style="color:orange;font-weight:bold">RS. <?php echo $price?></span><br>
                                <a href="edit_seller_product.php?pid=<?php echo $pid; ?>" style="color:white;"><button class="btn btn-primary"> Edit </button></a>
                                <button class="btn btn-danger del_btn" pid="<?php echo $pid?>"> Delete </button>
                            </div>      
                <?php
                        endwhile;
                    endif;
                   if($flag == 0)
                        echo "<p class='display-4 p-3'>This store containes 0 items.</p>";
                    
                ?>

            </div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            var productID = 0;
            $('.del_btn').click( function(){
                productID =  $(this).attr("pid");
                $(this).html("Item Deleted");
                $(this).attr("disabled", true);
                //finding parent div to hide item.
                /*var  p = $(this).parent().attr('class');
                arr = p . split(" ");
                parent = "." + arr[2];*/
               // $(this+parent).hide();
                
                 // adding data data in DB using AJAX POST method
                $.post(
                    'del_seller_product.php',
                    {
                        pid : productID 
                    },
                    function (status){ // this display status of ajax request
                        console.log(status);
                    }
                );
            });

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