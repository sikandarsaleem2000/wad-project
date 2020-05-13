<?php
    session_start();
    $email = $_SESSION["customer"]["forget_email"];
    
    include_once "includes/links.php"; 	
	include_once "includes/sweet_alerts.php";
	include_once "includes/connection.php";


    
    $pswd_err = $re_pswd_err = "";
    $pswd = $re_pswd = "";
    $error = false;
    
    if(isset($_POST["update_pswd_btn"])) {
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
        //echo "ABC".$error;
        //echo "<script>alert($error);</script>";
        if($error == false) {
            //echo "<script>alert('123    ');</script>";
           $sql = "UPDATE signup SET customer_pswd = '$pswd' WHERE customer_email = '$email'";
            if($conn->query($sql) === true){
                echo "<script>
                    Swal.fire(
                        'Password updated',
                        'Shoopers',
                        'success'
                    )
                </script>";
            }
            else{
                  echo "<script>warningAlert('error','Error in passowrd updation.');</script>";
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
        <title>Shooper | Update Password</title>
        <script src="js/main.js"></script>
    </head>

    <body style="background-color:#e6e6e6">
        <div class="container-fluid animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home</a> / <a href="login.php">Login</a> / Update Password</p>
				</div>
			</div>
		</div>

        <div class="container mt-5 animation">
			<div class="row">
				<div class="col-lg-9">
					<h3>Update your password?</h3>
				</div>
			</div>
		</div><br>
		
    	<form method = "POST">
        	<div class="container bg-white p-5 animation">				
				<div class="row d-flex justify-content-center">
					<div class="col-lg-6">
						<span class="text-danger">Enter your password to update</span><br><br>
						
                        <small>Enter password </small><small style="color:red"> * <?php echo $pswd_err?></small>
						<input type="password" class="form-control" placeholder="Please enter your password" name="pswd" id="pswd">
						
                        <small>Re-type password </small><small style="color:red"> * <?php echo $re_pswd_err?></small>
						<input type="password" class="form-control" placeholder="Please enter your password again" name="re_pswd" id="re_pswd">

                        <div class="custom-control custom-switch"><br>
							<input type="checkbox" class="custom-control-input" name="toggle_pswd" id="togglePswd" onclick="togglePassword()">
							<label class="custom-control-label" for="togglePswd" id="toggle"><small>Show Password </small></label>
						</div><br>
                        
                        <button class="btn btn-info btn-lg text-white mt-4" name="update_pswd_btn" id="updatePswdBtn" ><small>UPDATE PASSWORD</small></button>
					</div>
				</div>
			</div><br>
		</form>


    </body>
</html>
<?php include_once "includes/footer.php"?>