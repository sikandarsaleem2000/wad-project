<?php
    include_once "includes/links.php";
    include_once "includes/connection.php";
    include_once "includes/sweet_alerts.php";

    $name_err = $city_err = $price_err = $quantity_err = $description_err = $intro_err = "";
    $name = $city = $price = $quantity = $description = $intro = $img = "";
    $error = false;
    session_start();
    $sid = $_SESSION["seller"]["id"];
    if(isset($_POST["add_btn"])){


        //validation product name
		if(empty($_POST["name"])){
			$name_err = "Name is required.";
			$error = true;
		}
		else{
			$name = cleaning_data($_POST["name"]);

			if (!preg_match("/^[a-zA-Z -.,0-9]*$/",$name)) {
				$name_err = "Only characters and spaces allowed.";
				$error = true;
			} 
        }


        
        //validation intro
		if(empty($_POST["intro"])){
			$intro_err = "Intro is required.";
			$error = true;
		}
		else{
			$intro = cleaning_data($_POST["intro"]);

			if (!preg_match("/^[a-zA-Z -.,0-9]*$/",$intro)) {
				$intro_err = "Only characters and spaces allowed.";
				$error = true;
			} 
        }
        //validation city
		if(empty($_POST["city"])){
			$city_err = "City is required.";
			$error = true;
		}
		else{
			$city = cleaning_data($_POST["city"]);

			if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
				$city_err = "Only characters and spaces allowed.";
				$error = true;
			} 
        }

        //validation price
        if(empty($_POST["price"])){
            $price_err = "Price is required";
            $error = true;
        }
        else{
            $price = cleaning_data($_POST["price"]);
        }

        //validation quantity
        if(empty($_POST["quantity"])){
            $quantity_err = "Quantity is required";
            $error = true;
        }
        else{
            $quantity = cleaning_data($_POST["quantity"]);
        }
        
        //validation description
        if(empty($_POST["description"])){
            $description_err = "Description is required";
            $error = true;
        }
        else{
            $description = cleaning_data($_POST["description"]);
        }

    }

    function cleaning_data($data){
        $data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shoopers | Add Product</title>
    </head>
    <body style="background:#e6e6e6;">
        <div class="container-fluid  animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home /  </a><a href="seller_dashboard.php" class="my-auto">Dashboard</a> / Add Product</p>
				</div>
			</div>
        </div>
            <div class="container mt-5">
                <div class="row ">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6 bg-light p-4" style="border-left:5px solid lightblue">
                        <form method="POST" enctype="multipart/form-data">
                            <center><h3 class="font-weight-normal">Add Product Detail's</h3></center>
                            <hr/>
                            <label for="name"> Product Name</label><small style="color:red"> * <?php echo $name_err?></small>
                            <input type="text" value="<?php echo $name;?>" class="form-control" name="name" id="name" placeholder="Enter Product Name">

                            <label for="intro" class="mt-2"> Product Intro</label><small style="color:red"> * <?php echo $intro_err?></small>
                            <input type="text" value="<?php echo $intro;?>" class="form-control" name="intro" id="intro" placeholder="Enter Product Short Introduction">

                            <label class="mt-2" for="city"> Product City</label><small style="color:red"> * <?php echo $city_err?></small>
                            <input class="form-control" value="<?php echo $city;?>" name="city" id="city" type="text" placeholder="City">
                            
                            <div class="form-inline">
                                <input class="form-control mt-4" value="<?php echo $price;?>" MIN = "0" name="price" id="price" type="number" placeholder="Price" required>
                                <input class="form-control mt-4 ml-5" value="<?php echo $quantity;?>" MIN = "0" name="quantity" id="quantity" type="number" placeholder="Quantity" required>
                            </div>
                            
                            <input type="file" class="btn btn-light mt-4"  name="my_file" id="my_file"accept="image/*"><br>
                            
                            <label class="mt-2" for="description" >Product Description </label><small style="color:red"> * <?php echo $description_err?></small>
                            <textarea rows="6" cols="71" value="<?php echo $description;?>" name="description" class="form-control" id = "description"style="resize:horizontally;"></textarea>

                            <button class="btn btn-info mt-2" name="add_btn" id="add_btn">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </body>
    <script>
        $(document).ready(function(){
            $('.animation').hide();
            $('.animation').fadeIn(1500);

        });
    </script>
</html>
<?php
    include_once "includes/footer.php";

    if(isset($_POST["add_btn"])) {
        if($error == false){
            if($_FILES["my_file"]["name"] == ""){
                echo "<script>warningAlert('warning','Image is required.');</script>";
            }
            else {
                $target_dir = "uploads/";
                $img_name = basename($_FILES["my_file"]["name"]);	
                $imageFileType = pathinfo($img_name,PATHINFO_EXTENSION);
                $fileName = uniqid(). '.' .$imageFileType;
                $img_address = $target_dir . $fileName;
                move_uploaded_file($_FILES['my_file']['tmp_name'], $img_address);
                
                $sql = "INSERT INTO product (product_name, product_short_intro, product_location, product_price, product_quantity, 
                product_img, product_description, seller_id)
                VALUES('$name', '$intro', '$city', '$price', '$quantity', '$img_address', '$description', '$sid')";
        
                if($conn->query($sql) === true){
                    echo "<script> successAlert('success','Shop added successfully');</script>";
                    echo "<script>window.location.href = 'add_product.php'; </script>";
                }
                else{
                    echo "<script>warningAlert('warning','Error in products insertion.');</script>";
                }
            }
        }
    }
?>