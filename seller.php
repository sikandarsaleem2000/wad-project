<script src="js/main.js"></script>
<script src="jQuery/jQuery.js"></script>	

<?php
	include_once "includes/links.php"; 	
	include_once "includes/sweet_alerts.php";
	include_once "includes/connection.php";
  
	$shop_name = $contact_number = $city = $pswd = $email = "";
    $shop_name_err = $contact_number_err = $city_err = $pswd_err =$email_err  = "";
    $error = false;

    if(isset($_POST["add_shop"])) {
        
        //validation contact number
		if(empty($_POST["contact_number"])){
			$contact_number_err = "Contact number is required.";
			$error = true;
		}
		else{
			$contact_number = cleaning_data($_POST["contact_number"]);
			
			$sql = "SELECT *FROM seller WHERE seller_contact_no = '$contact_number'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				$contact_number_err = "This number already registerd.";
				$error = true;
			}
			elseif(!preg_match("/^03[0-9]{2}[0-9]{7}$/", $contact_number)) {
				$contact_number_err = "Enter Pakistan's phone number.";
				$error = true;
			} 
	       elseif(strlen($contact_number) < 11) {
                $contact_number_err =  "Number length is short.";
                $error = true;
            }
			elseif(!preg_match("/^03[0-9]{2}[0-9]{7}$/", $contact_number)) {
				$contact_number_err = "Enter Pakistan's contact number.";
				$error = true;
			} 
		}

		//validation shop name
		if(empty($_POST["shop_name"])){
			$shop_name_err = "Shop name is required.";
			$error = true;
		}
		else{
			$shop_name = cleaning_data($_POST["shop_name"]);

			if (!preg_match("/^[a-zA-Z0-9 ]*$/",$shop_name)) {
				$shop_name_err = "Only characters , Digits and spaces allowed.";
				$error = true;
			} 
        }
        
        //validation city
        if(empty($_POST["city"])){
			$city_err = "City name is required.";
			$error = true;
		}
		else{
			$city = cleaning_data($_POST["city"]);

			if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
				$city_err = "Only characters and spaces allowed.";
				$error = true;
			} 
        }


        //validation password
        if(empty($_POST["pswd"])) {
            $pswd_err = "Password is required.";
            $error = true;
        }
        else{
            $pswd = $_POST["pswd"];
            if(strlen($pswd) < 6){
                $pswd_err = "Password length must 6-digits or more.";
                $error = true;
            }
            //we have to implement password regular expression
            else if (!preg_match("/^[0-9a-zA-Z]*$/", $pswd)) {
                //"/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/"
                $pswd_err = "Password must contain 1 uppercase 1 lowercase and 1 special character.";
                $error = true;
            }
        }

        //validation email
		if(empty($_POST["email"])) {
			$email_err = "Email is required.";
			$error = true;
		}
		else{
			$email = cleaning_data ($_POST["email"]);
			$sql = "SELECT *FROM seller WHERE seller_email = '$email'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				$email_err = "This email already exist.";
				$error = true;
			}
			
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				$email_err = "Invalid email format.";
				$error = true;
			}
		}



		if($error == false) {
			$sql = "INSERT INTO seller (seller_shop_name, seller_contact_no, seller_city, seller_pswd, seller_email) 
			VALUES ('$shop_name', '$contact_number', '$city', '$pswd', '$email')";
			
			if($conn->query($sql) === true){

				echo "<script> successAlert('success','Shop added successfully');</script>";
				//echo "<script>setTimeout(function(){ sucessAlert('success','Shop added successfully'); }, 3000);</script>";
				echo "<script>window.location.href = 'seller.php'; </script>";
			}
			else{
				echo "<script>warningAlert('warning','Error in Seller information.');</script>";
			}
		}
	}

    // this function get data and then clean the data;
	function cleaning_data($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shoppers &mdash; Become Seller</title>
		<style>				
			img {
				transition: 0.70s;
				display: block;
				margin-right: auto;
				margin-left: auto;
			}

			img:hover {
				transition: 0.70s;
				transform: rotate(360deg);
			} 
		</style>
	</head>

	<body>
		
        <div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / Become Seller</p>
				</div>
			</div>
		</div>
		
        <div class="container p-5 mt-5 jumbotron animation">
            <p>Welcome! You are just one step away to sell on Shoppers.</p>
            <hr/>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="seller_signup_form">

				<div class="d-flex justify-content-center shop_img">
					<img  src="img/shop.PNG" width="100">
				</div>

                <div class="row">
                    <div class="col-lg-6">

                        <a href="seller_login.php">Login Here !</a>
                        <br>
                        <small>Shop Name </small><small style="color:red"> * <?php echo $shop_name_err?></small>
                        <input type="text" class="form-control" name="shop_name" id="shopName" value="<?php echo $shop_name?>">
						<br>
                        <small>Contact Number </small><small style="color:red"> * <?php echo $contact_number_err?></small>
                        <input type="text" maxlength = "11"class="form-control" value="<?php echo $contact_number?>" name="contact_number" id="contactNumber">
						<br>
                        <small>City </small><small style="color:red"> * <?php echo $city_err?></small>
                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $city?>">

                        
                    </div>

                    <div class="col-lg-6"><br>
                        <small>Password </small><small style="color:red"> * <?php echo $pswd_err?></small>
						<input type="password" value="<?php echo $pswd?>" class="form-control" placeholder="Minimum 6-digits password" name="pswd" id="pswd">
						<br>
                        <small>Email Address </small> <small style="color:red"> * <?php echo $email_err?></small>
						<input type="email" value="<?php echo $email?>"class="form-control" placeholder="Please enter your email" name="email" id="email">

                        <button class="btn btn-info btn-lg p-4 mt-4 btn-block" name="add_shop" id="addShop"> <small><i style="font-size:24px" class="fas fa-store-alt"></i> &nbsp;ADD SHOP</small></button>

                    </div>

                </div>
            </form>
        </div>

		<!-- Footer -->
		<?php include_once "includes/footer.php"; ?>
		
	</body>
</html>
<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);
	});
</script>