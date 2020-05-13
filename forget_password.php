<?php
	session_start();
	include_once "includes/connection.php";
	include_once "includes/links.php"; 
	include_once "includes/sweet_alerts.php";
	
	$email = $email_err =  "";
	$error = false;

	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		//validation email address
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

		if($error == false){
			$email = $_POST["email"];
			//echo "<script>alert('pressed');</script>";
			$sql = "SELECT *FROM signup WHERE customer_email = '$email'";

			$res = $conn->query($sql);
			$flag = 0;
			if($res->num_rows > 0){
				$flag = 1;
				$_SESSION["customer"]["forget_email"] = $email;
				header("Location:update_pswd.php");
			}	
			if($flag == 0){
				echo "<script>
					Swal.fire(
						'Email not found',
						'Shoopers',
						'error'
					)
				</script>";
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
<html>
	<head>
		<title>Forget Password</title>	
		<?php include_once "includes/links.php"; ?>	
		<script src="jQuery/jQuery.js"></script>

	</head>
	
	<body style="background-color:#e6e6e6">
		
		<div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / <a href="forget_pswd.php">Forget Password</a> / Update Password</p>
				</div>
			</div>
		</div>

		<div class="container mt-5 animation">
			<div class="row">
				<div class="col-lg-9">
					<h3>Forgot your password?</h3>
				</div>
			</div>
		</div><br>
		
		<div class="container bg-white p-5 animation">
			<form method="POST" action="?">				
				<div class="row d-flex justify-content-center">
					<div class="col-lg-6">
						<span>Enter your email address below and we’ll to reset your password</span><br><br>
						<small>Email address </small><small style="color:red"> * <?php echo $email_err?></small>
						<input type="text" class="form-control" placeholder="Please enter your email" name="email" id="email" required>
						<button class="btn btn-info btn-lg text-white mt-4" name="reset_pswd_btn" id="resetPswdBtn" ><small>RESET PASSWORD</small></button>
					</div>
				</div>
			</form><br>
		</div>
	</body>
	<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);
	});
</script>
</html>

<?php include_once "includes/footer.php"; ?>
