<!DOCTYPE html>
<html>
	<head>
  		<title>Shoppers Seller - Dashboard</title>
		<?php  
			error_reporting(0);
			session_start();
			if(!isset($_SESSION["seller"]["shop_name"])){
				header("Location:seller_login.php");
			}
			
			include_once "includes/links.php";
			include_once "includes/connection.php";
			$pid = $_SESSION["seller"]["id"];

			$total_stock = 0;

			$sql = "SELECT *FROM product WHERE seller_id = '$pid'";
			$res = $conn->query($sql);
			$total_stock = $res->num_rows;
		?>
		
	</head>
<body>

	<div class="container-fluid p-4 nav animation">
		<div class="container">
			<div class="row">		
				<div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
				<a href="index.php" class="text-primary shadow"><button class="btn btn-outline-dark btn-lg mt-2 p-3 w-100"><b>SHOOPERS</b></button></a>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid animation">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-sm-2 bg-info h-100 text-white" style="position:relative;bottom:122px;left:0">
				<div class="container-fluid" style="height:625px!important">
					<p class="ml-3 mt-2"><i style="font-size:20px" class="fa fa-tachometer-alt"></i> &nbsp; <b><?php echo  '<b>Shop : </b>'.$_SESSION["seller"]["shop_name"];  ?></b></p>

					<div class="dropdown">
						<button type="button" class="btn dropdown-toggle text-white" data-toggle="dropdown"><i class="fas fa-cog"  style="font-size:28px"></i> &nbsp; Features </button> 
						<div class="dropdown-menu dropdown-content-home">
							<a class="dropdown-item" href="add_product.php"><i style="font-size:20px" class="fa fa-plus-circle"></i> Add Product</a>
							<a class="dropdown-item" href="seller_view_all_products.php"><i style="font-size:20px"class="fa fa-eye"></i> View All Product</a>	
							<a class="dropdown-item" href="seller_logout.php"><i style="font-size:20px" class="fa fa-sign-out-alt"></i> Logout</a>
						</div>
					</div>
				</div>
			</div>	

			<div class="col-lg-10" style="background:#e6e6e6!important;height:511px!important">
				<div class="container-fluid" style="">
					<h2 class="font-weight-normal mt-5 shadow p-4">SELLER &mdash; DASHBOARD</h2>
					<div class="container">
					<div class="row mt-5">
						<div class="col-lg-5 ml-5 col-md-3 mt-2 col-sm-3 bg-light shadow p-5 box" style="border-left:5px solid orange;">
							<h4 class="text-primary font-weight-normal" >TOTAL PRODUCTS (STOCK)</h4>
							<h3 class="font-weight-normally total_stock"> <?php echo $total_stock?></h3>
						</div>
						
						<div class="col-lg-5 ml-5 col-md-3 mt-2 col-sm-3 p-5 bg-light shadow  box" style="border-left:5px solid green;">
						<h4 class="text-primary font-weight-normal" >TOTAL SOLD PRODUCTS</h4>
							<h4 class="font-weight-normally sold">0</h4>
						</div>
<!--
						<div class="col-lg-4 col-md-3 mt-2 col-sm-3 bg-light shadow p-4 box" style="border-left:5px solid darkblue;">
							<h5 class="text-primary font-weight-normal" >TOTAL EARNING's</h5>
							<h5 class="font-weight-normally earning">0</h5>
						</div>-->

					</div>			
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php  include_once "includes/footer.php";?>

<script>
	$(document).ready(function(){
		$('.animation').hide();
		$('.animation').fadeIn(1500);

		$({ countNum: $('.total_stock').html() }).animate({ countNum: 1000 }, {
            duration: 2000,
            easing: 'linear',
            step: function () {
            $('.total_stock').html(Math.floor(this.countNum));
        },
        	complete: function () {
            	$('.total_stock').html("00" +<?php echo $total_stock?>),
				$('.sold').html("00");
        	}
        });
	});
</script>