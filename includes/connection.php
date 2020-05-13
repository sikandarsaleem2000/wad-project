<?php
    $servername="localhost";
    $username="root";
    $password="";
    $dbname="wad_project";
	
	$conn = new mysqli($servername,$username,$password,$dbname);
	
	if($conn->connect_error){
		echo "Error in Database Connecting...";
	}
	else{
		//echo "Database Connected Successfully...";
	}
?>

<?php
/*
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wad_project";

    try {
        $conn = new PDO("mysql:host = $servername; dbname = $dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }*/
?>
