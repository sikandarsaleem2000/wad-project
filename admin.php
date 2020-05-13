<!DOCTYPE html>
<html>
	<head>
		<title>Shopers | Administration</title>
		<?php 
			include_once "includes/connection.php";
			include_once "includes/links.php";
		//	include_once "includes/header.php";

			$total_customers = $total_seller = $total_products = 0;
			
			$sql = "SELECT *FROM product";
			$res = $conn->query($sql);
			$total_products = $res->num_rows;

			$sql = "SELECT *FROM seller";
			$res = $conn->query($sql);
			$total_seller = $res->num_rows;

			$sql = "SELECT *FROM signup";
			$res = $conn->query($sql);
			$total_customers = $res->num_rows;


		?>
	</head>

	<body>


		<div class="container-fluid animation">
			<div class="row pb-3" style="background:#e6e6e6">
				<div class="container"><br>
				<p><a href="index.php">Home</a> /  Update Password</p>
				</div>
			</div>
		</div>
		<div class="container-fluid ">
			<div class="row mt-2" style="height:600px!important">

				<div class="col-lg-12 bg-light">
					<p class="display-4 p-5 text-center text-danger font-weight-bold"><img src="img/admin.PNG" width="6%"> ADMINISTRATION</p>
					<div class="container">
						<div class="row mt-5">
						    
							<div class="col-lg-4 mt-2 bg-light shadow p-5 box" style="border-left:5px solid orange;">
								<a href="view_all_customers.php"><h4 class="text-primary font-weight-normal" > CUSTOMERS</h4>
								<h3 class="font-weight-normally total_stock text-dark"><?php echo $total_customers?></h3></a>
							</div>
							

							<div class="col-lg-4 mt-2 bg-light shadow p-5 box" style="border-left:5px solid indigo;">
								<a href="view_all_sellers.php"><h4 class="text-primary font-weight-normal" >TOTAL SELLERS</h4>
								<h3 class="font-weight-normally total_stock text-dark"> <?php echo $total_seller?></h3></a>
							</div>

							<div class="col-lg-4 mt-2 bg-light shadow p-5 box" style="border-left:5px solid red;">
								<a href="view_all_products.php"><h4 class="text-primary font-weight-normal" > PRODUCTS</h4>
								<h3 class="font-weight-normally total_stock text-dark"> <?php echo $total_products?></h3></a>
							</div>

						</div>
					</div>
				</div>	
			</div>
		</div>
	</body>
</html>

<?php include_once "includes/footer.php"?>


