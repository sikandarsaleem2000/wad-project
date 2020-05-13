<?php
	session_start();
	//include_once "includes/header.php"; 
	if(isset($_SESSION["seller"]["id"])){
		header("Location:seller_dashboard.php");
	}	

	include_once "includes/links.php";
	include_once "includes/sweet_alerts.php";
	$email = $pswd = "";
	$email_err = $pswd_err = "";
	$error = false;


	if($_SERVER["REQUEST_METHOD"] == "POST") {

		//validating email
		if(empty($_POST["email"])) {
			$email_err = "Email is required.";
			$error = true;
		}
		else{
			$email = cleaning_data ($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_err = "Invalid email format.";
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
		}



		if($error == false) {	
			include_once "includes/connection.php";
			$user_pswd = $shop_name = $sid = "";
	
			$sql = "SELECT  *FROM seller WHERE seller_email = '$email'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				while($data = $result->fetch_assoc()){
					$user_pswd = $data['seller_pswd'];
					$shop_name = $data["seller_shop_name"];
					$sid 	   = $data["SID"];
					//echo 
				}
			}
			if($user_pswd == $pswd){
				header("Location: seller_dashboard.php");
				//echo "<script>alert($sid);</script>";

			}
			else{
				echo "<script>warningAlert('warning', 'Invalid email or password.');</script>";
			}
			$_SESSION["seller"]["shop_name"] = $shop_name;
			$_SESSION["seller"]["id"] = $sid;
			
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
<html>
	<head>
		<title>Shoppers &mdash; Seller Login</title>
		<script src="jQuery/jQuery.js"></script>

	</head>
	
	<body style="background-color:#e6e6e6">
		
		<div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / Seller Login</p>
				</div>
			</div>
		</div>

		<div class="container mt-5 animation">
			<div class="row">
				<div class="col-lg-9">
					<h3>Welcome to Shoppers! Please login</h3>
				</div>
					
				<div class="col-lg-3">
					<small>New Seller? <a href="seller.php">Register</a> here.</small>
				</div>
			</div>
		</div><br>
		
		<div class="container bg-white p-5 animation">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">				
				<div class="row d-flex justify-content-center">
					<div class="col-lg-6">
						<small>Phone Number </small><small style="color:red"> * <?php echo $email_err?></small>
						<input type="text" class="form-control" placeholder="Enter email address" name="email" id="email"><br>
						
						<small>Password </small><small style="color:red"> * <?php echo $pswd_err?></small>
						<input type="password" class="form-control" placeholder="Please enter your password" name="pswd" id="pswd"><br>
						

						<button class="btn btn-info btn-lg btn-block p-3" name="seller_login_btn" id="sellerLoginBtn"><i style="font-size:24px;"class="fas fa-sign-in-alt"></i> &nbsp;LOGIN</button><br>

				    </div>
                </div>
			</form><br>
		</div>
	</body>
</html>
<?php include_once "includes/footer.php"; ?>

<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);
	});
</script>