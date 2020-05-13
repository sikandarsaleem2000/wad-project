<?php
	$fname = $lname = $email = $subject = $msg = "";
	$fname_err = $lname_err = $email_err = $msg_err = "";
	$error = false;

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//validation fname
		if(empty($_POST["fname"])) {
			$fname_err = "First Name is required.";
			$error = true;
		}
		else{
			$fname = cleaning_data($_POST["fname"]);
			if(!preg_match("/^[A-Za-z]*$/", $fname)) {
				$fname_err = "Only alphabetics and spaces are allowed.";
				$error = true;
			}
		}
	

		//validation lname
		if(empty($_POST["lname"])) {
			$lname_err = "Last name is required.";
			$error = true;
		}
		else{
			$lname = cleaning_data($_POST["lname"]);
			if(!preg_match("/^[A-Za-z]*$/", $lname)) {
				$lname_err = "Only alphabetics and spaces are allowed.";
				$error = true;
			}
		}


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

		//validation subject
		if(empty($_POST["subject"])) {

		}
		else{
			$subject = cleaning_data($_POST["subject"]);
		}



		//validating message
		if(empty($_POST["msg"])) {
			$msg_err = "Message is required.";
			$error = true;
		}
		else{
			$msg = cleaning_data($_POST["msg"]);
		}



		if($error == false) {
			if(mail("sikandarsaleem2000@gmail.com", $subject, $msg))
				echo "<script>alert('Mail Send');</script>";
			else	
				echo "<script>alert('Mail NOT Send');</script>";
			
			
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
		<title>Shoppers &mdash; Contact Us</title>
		<?php include_once "includes/links.php"; ?>	
		<script src="jQuery/jQuery.js"></script>

	</head>
	
	<body>
		<div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / Contacts Us</p>
				</div>
			</div>
		</div>

		<div class="container mt-4 animation">
			<h3>Get in Touch</h3>
			<div class="row">
				<div class="col-lg-7 border p-5 mt-2">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="row">
							<div class="col-lg-6">
								<span>First name </span><small style="color:red"> * <?php echo $fname_err?></small>
								<input type="text" class="form-control" name="fname" id="fname">
							</div>
							
							<div class="col-lg-6">
								<span>Last name </span><small style="color:red"> * <?php echo $lname_err?></small>
								<input type="text" class="form-control" name="lname" id="lname">
							</div>
						</div><br>
						<span>Email </span><small style="color:red"> * <?php echo $email_err?></small>
						<input type="email" class="form-control" name="email" id="email"><br>
						
						<span>Subject</span>
						<input type="text" class="form-control" name="subject" id="subject"><br>
						
						<span>Message </span><small style="color:red"> * <?php echo $msg_err?></small>
						<textarea class="form-control" rows="7" cols="40"  name="msg" id="msg"></textarea><br>
						
						<button class="btn btn-info btn-purple btn-lg btn-block" name="contacts_us_btn" id="contactsUsBtn"><small>SEND MESSAGE</small></button>
					</form>
				</div>
				
				<div class="col-lg-5 mt-2">
					<div class="border p-4">
						<span class="text-purple"><i class="fas fa-map-marker-alt"></i> LAHORE<span><br>
						<span class="text-muted">University Of Central Punjab, Lahore, Pakistan<span>
					</div><br>
					
					<div class="border p-4">
						<span class="text-purple"><i class="fas fa-map-marker-alt"></i> FAISALABAD<span><br>
						<span class="text-muted">University Of Central Punjab, Faislabad, Pakistan<span>
					</div><br>
					
					<div class="border p-4">
						<span class="text-purple"><i class="fas fa-map-marker-alt"></i> ISLAMABAD<span><br>
						<span class="text-muted">University Of Central Punjab, Islamabad, Pakistan<span>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php include_once "includes/footer.php";?>

<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);
	});
</script>