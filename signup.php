<script src="js/main.js"></script>
<script src="jQuery/jQuery.js"></script>

<?php 

	include_once "includes/links.php"; 	
	include_once "includes/sweet_alerts.php";
	include_once "includes/connection.php";
	
	$phone_no_err = $pswd_err = $re_pswd_err = $dob_err =  $gender_err  = $email_err = $name_err = "";
	$phone_no = $pswd = $re_pswd = $dob =  $gender  = $email = $name = "";
	$permotion_status = "false"; 
	$error = false;

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//validation phone number
		if(empty($_POST["phone_no"])){
			$phone_no_err = "Phone number is required.";
			$error = true;
		}
		else{
			$phone_no = cleaning_data($_POST["phone_no"]);
			
			$sql = "SELECT *FROM signup WHERE customer_phone_no = '$phone_no'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				$phone_no_err = "This number already registerd.";
				$error = true;
			}
			else {
				if(!preg_match("/^03[0-9]{2}[0-9]{7}$/", $phone_no)) {
					$phone_no_err = "Enter Pakistan's phone number.";
					$error = true;
				} 
			}
		}

		//validation user name
		if(empty($_POST["name"])){
			$name_err = "Name is required.";
			$error = true;
		}
		else{
			$name = cleaning_data($_POST["name"]);

			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$name_err = "Only characters and spaces allowed.";
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

		//validate re-paswword
		if(empty($_POST["re_pswd"])) {
			$re_pswd_err = "Re-password is required.";
			$error = true;
		}
		else{
			$re_pswd = $_POST["re_pswd"];
			if($re_pswd !== $pswd){
				$re_pswd_err = "Re-password not matched.";
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
			$sql = "SELECT *FROM signup WHERE customer_email = '$email'";
			$result = $conn->query($sql);
			
			if($result->num_rows > 0){
				$email_err = "This email already exist.";
				$error = true;
			}

			else{ 
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$email_err = "Invalid email format.";
					$error = true;
				}
			}
		}

		//validation dob
		if(empty($_POST["dob"])) {
			$dob_err = "DOB is required.";
			$error = true;
		}
		else{
			$dob = cleaning_data($_POST["dob"]);

			date_default_timezone_set("Asia/Karachi");
			$current_date = date("Y-m-d");

			//we have to check is dob greater then current data
			if($current_date < $dob) {
				$dob_err = "DOB must less then Current Date.";
				$error = true;
			}
		}


		//validating gender
		if(empty($_POST["gender"]) || $_POST["gender"] == "null") {
			$gender_err  = "Gender is required.";
			$error = true;
		}
		else{
			$gender = cleaning_data($_POST["gender"]);
		}

		//getting promotion option
		if(isset($_POST["permotion_status"])){
			$permotion_status = "true";
		}





		if($error == false) {
			
			$sql = "INSERT INTO signup (customer_phone_no, customer_pswd, customer_dob, customer_gender, customer_name, customer_email,
			customer_permotion_status) VALUES ('$phone_no', '$pswd', '$dob', '$gender', '$name', '$email', '$permotion_status')";
			
			if($conn->query($sql) === true){
				echo "<script> successAlert('success','Shop added successfully');</script>";
				//echo "<script>setTimeout(function(){ sucessAlert('success','Shop added successfully'); }, 3000);</script>";
				echo "<script>window.location.href = 'signup.php'; </script>";
			}
			else{
				echo "<script>warningAlert('warning','Error in Customer information.');</script>";
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
		<title>Shoppers &mdash; Signup Form</title>

	</head>

	<body style="background-color:#e6e6e6">
	
		<div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / Signup</p>
				</div>
			</div>
		</div>

		<div class="container mt-5 animation">
			<div class="row">
				<div class="col-lg-9">
					<h3>Create your Shoppers Account</h3>
				</div>
						
				<div class="col-lg-3">
					<small>Already member <a href="login.php">Login</a> here</small>
				</div>
			</div>
		</div>
		
		<div class="container bg-white p-4 animation">
			<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">					
				<div class="row mt-5">
					<div class="col-lg-6">
						<small>Phone Number </small><small style="color:red"> * <?php echo $phone_no_err?></small>
						<input type="text" value="<?php echo $phone_no?>" maxlength="11" class="form-control" placeholder="Enter phone number ( 03001234567 )" name="phone_no" id="phoneNo"><br>
						
						<small>Password </small><small style="color:red"> * <?php echo $pswd_err?></small>
						<input type="password" value="<?php echo $pswd?>" class="form-control" placeholder="Minimum 6-digits password" name="pswd" id="pswd"><br>

						<div class="custom-control custom-switch">
							<input type="checkbox" class="custom-control-input" name="toggle_pswd" id="togglePswd" onclick="togglePassword()">
							<label class="custom-control-label" for="togglePswd" id="toggle"><small>Show Password </small></label>
						</div><br>

						<small>Re-type Password </small> <small style="color:red"> * <?php echo $re_pswd_err?></small>
						<input type="password" value="<?php echo $re_pswd?>" class="form-control" placeholder="Retype password" name="re_pswd" id="rePswd"><br>
					

						<div class="row">
							<div class="col-lg-7">
								<small>Birthday </small><small style="color:red"> * <?php echo $dob_err?></small>
								<input type="date" value="<?php echo $dob?>" class="form-control" name="dob" id="dob">
							</div>
							<div class="col-lg-5">
								<small>Gender </small></small><small style="color:red"> * <?php echo $gender_err?></small>
								<select class="form-control" name="gender" id="gender">
									<option value="null" <?php if($gender=="----") echo 'selected="selected"'; ?> >----</option>
									<option value="Male" <?php if($gender=="Male") echo 'selected="selected"'; ?> >Male</option>
									<option value="Female" <?php if($gender=="Female") echo 'selected="selected"'; ?> >Female</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="col-lg-6">
						<small>Full Name</small><small style="color:red"> * <?php echo $name_err?></small>
						<input type="text" value="<?php echo $name?>" class="form-control" placeholder="Enter your first and last name" name="name" id="name"><br>
						
						<small>Email Address </small> <small style="color:red"> * <?php echo $email_err?></small>
						<input type="email" value="<?php echo $email?>"class="form-control" placeholder="Please enter your email" name="email" id="email"><br>
						
						<div class="custom-control custom-checkbox mb-3">
							<input type="checkbox" <?php if (isset($permotion_status) && $permotion_status=="true") echo "checked"?> value="true" class="custom-control-input" id="permotionStatus" name="permotion_status">
							<label class="custom-control-label" for="permotionStatus">I want to receive exclusive offers and promotions</label><br>
							<label>from Shopper`s.</label>
						</div>
						
						<button class="btn btn-info btn-lg btn-block p-3" name="submit_btn" id="submitBtn"><i style="font-size:24px;" class="fa fa-user-plus"></i> &nbsp;SIGN UP</button>
						<small>By clicking "SIGN UP" I agree to <a href="">Shopper`s Privacy Policy</a></small><br>
						<small>Or, signup with,</small>
						<div class="row">
							<div class="col-lg-6">
								<button class="btn btn-primary btn-lg btn-block mt-3" disabled="true" name="fb_signup_btn" id="fbSignUpBtn"><i class="fa fa-facebook-f"></i>&nbsp; Facebook</button>
							</div>
							
							<div class="col-lg-6">
								<button class="btn btn-danger btn-lg btn-block mt-3" disabled="true" name="google_signup_btn" id="googleSignUpBtn"><i class="fa fa-google-plus-g"></i>&nbsp; Google</button>
							</div>
						</div>
						<br><br>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>


<!-- Including footer -->
<?php include_once "includes/footer.php"; ?>


<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);
	});
</script>