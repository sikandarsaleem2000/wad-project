<!DOCTYPE html>
<html lang="en">
	<head>
		<script src="jQuery/jQuery.js"></script>
		<title>Shoppers &mdash; Header</title>
		<?php include_once "includes/links.php"; ?>	
		<style>
			input, button, select{
				border-radius:0!important;
			}
		</style>
	</head>



	<body>	
		<div class="container-fluid p-4 nav">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-4">
						<button class="btn btn-outline-info btn-block mt-2 p-3"name="search_show_btn" id="seachShowBtn">SHOP PRODUCTS <i style="font-size:22px" class="fa fa-shopping-cart"></i>&nbsp;&nbsp;</i></button>
					</div>
					
					<div class="col-lg-4 d-flex justify-content-center">
						<a href="index.php"><button class="btn btn-outline-dark w-100 p-3 btn-lg mt-2">SHOOPERS</button></a>
					</div>

					<?php 
						session_start();
						if(isset($_SESSION["customer"]["email"])):
					?>
						<div class="col-lg-4 d-flex justify-content-end mt-2 icons"><br><br>
							<div class="dropdown mt-2">
								<button type="button" class="btn btn-light dropdown-toggle p-3" data-toggle="dropdown"> <?php echo $_SESSION["customer"]["email"];?> &nbsp;</button>
								<div class="dropdown-menu dropdown-content-home">
									<!-- <a class="dropdown-item" href="#"><i class="fas fa-chart-line">&nbsp;&nbsp;</i> Dashboard</a> -->
									<a class="dropdown-item" href="order_history.php"><i class="fa fa-shopping-cart mt-3"></i>&nbsp;&nbsp;</i>Shopping History</a>
									<a class="dropdown-item" href="view_cart.php"><i class="fa fa-shopping-cart mt-3"></i>&nbsp;&nbsp;</i>Cart</a>
									<a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt"></i>Logout</a>
		
								</div>
							</div>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		
			
		<form  class="form-inline" method="GET" action="search_items_by_title.php">
			<div class="container search_nav">
				<!--<input type="text" placeholder="Location (City)" name="city" class="form-control mt-2">
				<input type="text" placeholder="Product name" name="produt_name" class="form-control mt-2">

				
				<small class="ml-3 mt-3">RANGE</small> <input type="number" style="width:90px!important"placeholder="MIN" name="min_range" class="form-control mt-2">
				<input type="number" style="width:90px!important"placeholder="MAX" name="max_range" class="form-control mt-2">
				
				<select class="form-control mt-2 ml-1" name="filter">
					<option value="null">Search by</option>
					<option value="rating">Rating</option>
					<option value="lth">Price Low to High</option>
					<option value="htl">Price High to Low</option> 
				</select>-->
				<input style="width:360px!important" name="search_query"class="form-control mt-2 p-3" placeholder="Search Items">
				<button style="width:360px!important"class="btn btn-info mt-2" name="search_btn">
					<!--<a href="search_items_by_title.php" class="text-white">SEARCH ITEMS</a>&nbsp;&nbsp;<i class="fas fa-search"></i> -->
					SEARCH ITEMS</a>&nbsp;&nbsp;<i class="fa fa-search"></i>
				</button>
				<button style="width:360px!important" name="filter_btn"class="btn btn-primary mt-2"><a href="filter.php" class="text-white">APPLY FILTERS</a></button>
			</div>
		</form>

		<hr>
		<nav class="navbar navbar-expand-lg navbar-light bg-light header">
			<!-- <a class="navbar-brand" href="#">Navbar</a> -->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapsed" aria-controls="navbarCollapsed" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		  
			<div class="collapse navbar-collapse justify-content-center" id="navbarCollapsed">
				<ul class="nav navbar-nav">
					<li class="nav-item">
						<a class="nav-link ml-4" href="index.php"><small>HOME</small></a>
					</li>
		

					<li class="nav-item">
						<a class="nav-link ml-4" href="search_item.php"><small>NEW ARRIVAL</small></a>
					</li>

					<li class="nav-item">
						<a class="nav-link ml-4" href="shop_items.php"><small>SHOP ITEMS</small></a>
					</li>

					<li class="nav-item">
						<div class="dropdown">
							<a class="nav-link dropdown-toggle dropdown-link-home ml-4" data-toggle="dropdown"><small>SELLER </small></a>
							<div class="dropdown-menu dropdown-content-home">
								<a class="dropdown-item" href="seller_dashboard.php">Dashboard</a>
								<a class="dropdown-item" href="seller_login.php">Login</a>
								<a class="dropdown-item" href="seller.php">Signup</a>
							</div>
						</div>
					</li>
					
					<li class="nav-item">
						<a class="nav-link ml-4" href="login.php"><small>LOGIN</small></a>
					</li>
			
					<li class="nav-item">
						<a class="nav-link ml-4" href="signup.php"><small>SIGNUP</small></a>
					</li>
				</ul>
			</div>
		</nav>
	</body>
</html>

<script>
	$(document).ready(function() {
		$('.navb, .header,.search_nav').hide();
		$('.header, .navb').show(1500);

		$("button").first().css("cursor", "pointer");
		$("button").first().click(function(){
  			$(".search_nav").toggle(1000);
		});
	});
</script>

