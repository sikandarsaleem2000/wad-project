<?php
	session_start();
	//include_once "includes/header.php"; 

	if(isset($_SESSION["customer"]["email"])){
		header("Location:index.php");
	}

	include_once "includes/links.php"; 	
	include_once "includes/sweet_alerts.php";

	$email = $pswd = "";
	$email_err = $pswd_err = "";
	$error = false;

	if(isset($_POST["login_btn"])) {

		//validating email
		if(empty($_POST["email"])) {
			$email_err = "Email is required.";
			$error = true;
		}
		else{
			$email = cleaning_data($_POST["email"]);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
			$user_pswd = $name = $user_id = "";
			$sql = "SELECT  *FROM signup WHERE customer_email = '$email'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				while($data = $result->fetch_assoc()){
					$user_pswd = $data['customer_pswd'];
					$user_id = $data["CID"];
					$name = $data["customer_name"];

				}
			}
			if($user_pswd == $pswd){
				if(!isset($_SESSION["redirectURL"])){
					header("Location: index.php");
					//header("Location: {$_SERVER['HTTP_REFERER']}");
				}
				else{
					$redirectedURL = $_SESSION["redirectURL"];
					header("Location: ".$redirectedURL);
				}

			}
			else{
				echo "<script>warningAlert('warning', 'Invalid email or password.');</script>";
			}

			$_SESSION["customer"]["email"] = $email;
			$_SESSION["customer"]["id"] = $user_id;
			$_SESSION["customer"]["name"] = $name;
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
		<title>Shoppers &mdash; Login Form</title>
		<script src="jQuery/jQuery.js"></script>

	</head>
	
	<body style="background-color:#e6e6e6">
		
		<div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / Login</p>
				</div>
			</div>
		</div>

		<div class="container mt-5 animation">
			<div class="row">
				<div class="col-lg-9">
					<h3>Welcome to Shoppers! Please login</h3>
				</div>
					
				<div class="col-lg-3">
					<small>New memeber? <a href="signup.php">Register</a> here.</small>
				</div>
			</div>
		</div><br>
		
		<div class="container bg-white p-5 animation">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">				
				<div class="row">
					<div class="col-lg-6">
						<small>Phone Number or Email </small><small style="color:red"> * <?php echo $email_err?></small>
						<input type="text" class="form-control" placeholder="Enter phone number or email" name="email" id="email"><br>
						
						<small>Password </small><small style="color:red"> * <?php echo $pswd_err?></small>
						<input type="password" class="form-control" placeholder="Please enter your password" name="pswd" id="pswd"><br>
						
						<a href="forget_password.php">Forget Password</a>
					</div>
					
					<div class="col-lg-6"><br>
						<button class="btn btn-info btn-lg btn-block p-3" name="login_btn" id="loginBtn"><i style="font-size:24px;"class="fa fa-sign-in-alt"></i> &nbsp;LOGIN</button><br>
						<small>Or, login with</small>
						<button class="btn btn-primary btn-lg btn-block" disabled="true" name="fb_login_btn" id="fbLoginBtn"><i class="fa fa-facebook-f"></i>&nbsp; Facebook</button>
						<button class="btn btn-danger btn-lg btn-block" disabled="true" name="google_login_btn" id="googleLoginBtn"><i class="fa fa-google-plus-g"></i>&nbsp; Google</button>
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
