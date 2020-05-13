<script src="js/main.js"></script>
<script src="jQuery/jQuery.js"></script>

<?php
    $description = "";
    include_once "includes/header.php";
    include_once 'includes/connection.php'; 
    include_once "includes/links.php";
    include_once "includes/sweet_alerts.php";
    $pid = $_GET['pid'];

    $_SESSION["product"]["id"] = $pid;
?>

<!DOCTYPE html>
<hmtl>
    <head>
        <title>Shoopers &mdash; Products | Details</title>
    </head>

    <body>
        <div class="jumbotron container mt-5 p-3">
            <div class="row">
                <?php
                    $sql = "SELECT *FROM product WHERE PID = '$pid' LIMIT 1" ;
                    $res = $conn->query($sql);
                    if($res->num_rows > 0):
                        while($data = $res->fetch_assoc()):
                            $name           = $data["product_name"];
                            $description    = $data["product_description"];
                            $city           = $data["product_location"];
                            $price          = $data["product_price"];
                            $intro          = $data["product_short_intro"];
                            $pid            = $data["PID"];
                            $img_address    = $data["product_img"];

                            $discount_price = $price / 10;
                ?>
                <div class="col-lg-3 mt-2">
                    <img src="<?php echo $img_address?>" width="100%" height="250px">
                </div>

                <div class="col-lg-6">
                    <h2 class="font-weight-normal"><?php echo $name;?></h2>
                    <small><?php echo $intro;?></small>
                    <hr>
                    <span style="color:orange;font-weight:bold">RS. <?php echo $price?> </span><br> 
                    <small> <strike> <?php echo $price + $discount_price; ?> </strike> </small> <small><?php  echo ", 10% OFF"?></small><br>
                    <small class="text-muted">Permotion</small> <small class="bg-warning text-white p-1 rounded">No permption availabel on this product.</small><br><br>
                    
                    <form class="form-inline">
                        <span>Quantity &nbsp;</span><input type="number" MIN="1" value = "1" required name="quantity" id="quantity" class="form-control">
                        
                    </form>
                        <hr/>
                        <button class="btn btn-danger cart_btn" pid="<?php echo $pid?>"> <i class="fa fa-shopping-cart"></i> Add to Cart </button>
                        
                </div>

                <div class="col-lg-3">
                    <b>Delivery option's</b><br>
                    <i class="fas fa-map-marker-alt text-muted ml-3"></i><small>&nbsp;&nbsp;<?php echo"  ". $city; ?> , Pakistan</small>
                    
                    <hr/>
                    <i class="fas fa-american-sign-language-interpreting text-muted"></i><small class="ml-2" >Home Delivery </small><br>
                    <small class="text-muted ml-4"> &nbsp;1 - 7 Days</small><small style="float:right">Free Delivery</small><br><br>
                    <i class="fas fa-money-bill-wave text-muted"></i><small class="ml-2">Cash on Delivery Available</small>
                    <hr/>
                    <small class="text-muted">Return & Warranty</small><br>
                    <i class="fas fa-circle-notch text-muted"></i><small> &nbsp;7 Days return</small><br>
                    <small class="text-muted ml-4">Change of mind is not applicable</small><br><br>

                    <i class="fas fa-shield-alt text-muted"></i><small> &nbsp;1 Month Warrenty</small>
                    <hr/>
                </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
        <!-- Reviews and description dextion  -->
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="font-weight-normal p-3 bg-light"> Product Description</h2>
                    <p class="border p-3"><?php echo $description?></p>
                </div>
               
            <!-- Comment section started here -->
            </div><br />
            <hr /><br>
                <h4 class="font-weight-normal text-muted mt-3">Comment Section</h4><br/>
                <!-- <form method="POST"> -->
                    <input type="text" value="<?php echo $_SESSION["customer"]["email"]?>"name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" readonly/><br/>
                    <textarea name="comment_content" id="comment_content" class="form-control mt-3" placeholder="Enter Comment" rows="5"></textarea><br/>
                    <button pid="<?php echo $pid;?>" class="btn btn-primary add_comment"> Add Comment </button>
                <!-- </form> -->
               <div class="container mt-3">
                    <div class="comments">
                        <?php
                            $sql = "SELECT *FROM comments WHERE pid = '$pid' ";
                            $res = $conn->query($sql);
                            if($res->num_rows > 0){
                                while($data = $res->fetch_assoc()){
                                    $sender = $data["sender_name"];
                                    $comment = $data["comment"];
                                    $date_time = $data["date"];
                                    echo "<hr>";
                                    echo "<span class='text-primary'> $sender ($date_time)</span><br>";
                                    echo "<small class='ml-4'>$comment</small>";
                                    echo "<hr/>";
                                }
                            }
                        ?>
                    </div>
               </div>

        </div>
    </body>

    <script>
        $(document).ready(function() {

            $('.add_comment').click(function() {
                var productID  =  $(this).attr("pid");
                var commenterName = $("#comment_name").val();
                var commentContent = $("#comment_content").val();
                if(commenterName != "" && commentContent != ""){
                   $.post(
                        'add_comment.php',
                        {
                            pid : productID,
                            senderName : commenterName,
                            comment : commentContent
                        },
                        function(response){
                            if(response != ""){
                                Swal.fire(
                                    response,
                                    'Shoopers',
                                    'success'
                                )
                            }
                        }
                        
                    );
                }
                else{
                    Swal.fire(
                        'Enter comment in comment section',
                        'Shoopers',
                        'error'
                    )
                }
            });
            $('.cart_btn').click( function(){
                var productID  =  $(this).attr("pid");
                var quantity = $("#quantity").val();
                if(quantity > 0)   {
                  //  $(this).attr("disabled", true);

                    // adding data data in DB using AJAX POST method
                    $.post(
                        'add_to_cart.php',
                        {
                            PID : productID,
                            p_quantity : quantity
                        },
                        function (response){ // this display status of ajax request
                            if(response == "Product added in cart"){
                                Swal.fire(
                                    response,
                                    'Shoopers',
                                    'success'
                                )
                            }
                            else{
                                Swal.fire(
                                    response,
                                    'Shoopers',
                                    'success'
                                )
                            }          
                        }
                    );
                }
                else{
                    Swal.fire(
                        'Quantity must be atleast 1',
                        'Shoopers',
                        'error'
                    )
                }
            })

            // designing 
            
            $(".item-box").hover(function(){
                $(this).addClass("shadow");
                $(this).css("background-color","#e6e6e6");
            }, function(){      
                $(this).removeClass("shadow");
                $(this).css("background-color","");
            });
        });
    </script>
</html>

<?php
    include_once "includes/footer.php";
?>