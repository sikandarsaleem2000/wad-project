<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shoppers &mdash; Home</title>
	</head>

	<body>
		<script src="jQuery/jQuery.js"></script>
		<!-- Include Navbar -->
		<?php 
			error_reporting(0);
			session_start();
			include_once "includes/links.php";	
			include_once "includes/header.php"; 	
		?>
		







 <!--
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Open modal
  </button>


 <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        
        <div class="modal-header">
          <h4 class="modal-title text-danger ">Welcome to SHOPPERS Sale</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
    
        <div class="modal-body ">
         <img src="img/sale.gif" width="100%">
        </div>
        
    
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div> 




-->


		
		<!--Slider-->
		<div id="demo" class="carousel slide slider" data-ride="carousel">

			<!-- Indicators -->
			<ul class="carousel-indicators">
					<li data-target="#demo" data-slide-to="0" class="active"></li>
					<li data-target="#demo" data-slide-to="1"></li>
					<li data-target="#demo" data-slide-to="2"></li>
			</ul>
			
			<!-- The slideshow -->
            <div class="carousel-inner"> 
				<div class="carousel-item active">
                    <img src="img/img1.webp" alt="Ecommerece Wallpaper" width="100%" height="700">
                </div>
				
                     
                <div class="carousel-item">
                    <img src="img/img2.JPG" alt="Ecommerece Wallpaper" width="100%" height="700">
                </div>

				<div class="carousel-item">
                    <img src="img/img3.JPEG" alt="Ecommerece Wallpaper" width="100%" height="700">
                </div>
        	</div>
        
      	  <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>

            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>

		<marquee scrollamount="13"> <h3 class="text-danger p-4" >  •  Sale! Sale! on 31 January, 2020   • </h3></marquee>
		
		<div class="container">
			<div class="row home-page-icons services">
				<div class="col-lg-4 mt-2">
					<i class="fa fa-truck"></i><span class="ml-2"> <b>FREE SHIPPING</b></span><br>
					<span class="ml-5">Shopper online shopping store<span><br>
					<span class="ml-5">provide free shopping service<span><br>
					<span class="ml-5">in whole country.<span><br>
				</div>
				
				<div class="col-lg-4 mt-2">
					<i class="fa fa-undo"></i><span class="ml-2"> <b>FREE RETURN</b></span><br>
					<span class="ml-5">Shopper online shopping store<span><br>
					<span class="ml-5">provide free return service<span><br>
					<span class="ml-5">to all his customers.<span><br>
				</div>
				
				<div class="col-lg-4 mt-2">
					<i class="fa fa-question-circle"></i><span class="ml-2"> <b>CUSTOMER SUPPORT</b></span><br>
					<span class="ml-5">Shopper online shopping store<span><br>
					<span class="ml-5">provide customer support to<span><br>
					<span class="ml-5">his customers for interaction.<span><br>
				</div>
			</div>
		</div>
		<hr class="mt-5">
		
		
		<!-- Collection Options -->
		
		<div class="container mt-5">
			<div class="row collection-img">
				<div class="col-lg-4">
					<div class="card img-fluid" width="100%">
						<img class="card-img-top" src="img/men.JPG" width="100%">
						<span class="card-img-overlay font-weight-bold text-white">COLLECTIONS</span>
						<h2 class="card-img-overlay text-white mt-4">MENS / BOYS</h2>
						
					</div>
					
				</div>
				
				<div class="col-lg-4">
					<div class="card img-fluid" width="100%">
						<img class="card-img-top" src="img/children.JPG" width="100%">
						<span class="card-img-overlay font-weight-bold text-white">COLLECTIONS</span>
						<h2 class="card-img-overlay text-white mt-4">CHILDRENS</h2>
						
					</div>
					
				</div>
				
				<div class="col-lg-4">
					<div class="card img-fluid" width="100%">
						<img class="card-img-top" src="img/women.JPG" width="100%">
						<span class="card-img-overlay font-weight-bold text-white">COLLECTIONS</span>
						<h2 class="card-img-overlay text-white mt-4">LADIES</h2>
						
					</div>
					
				</div>
			</div>
		</div>
		
		
		
		<!-- Feature Products -->
		
		
		<div class="jumbotron mt-5">
			<div class="container">
				<center>
					<hr width="60" size="30" style="border-color:#7971ea">
					<h2>New Arrivals</h2>
				</center>
				
				<div class="row mt-5 bg-light">
					<div class="col-lg-3 p-2">
						<img src="img/macbook.png" width="100%">
						<center><br>
							<h5 style="color:#7971ea">Laptops</b></h5>
							<p class="text-grey">Finding perfect products</p>
							<p style="color:#7971ea">Staring from PKR 150,000/-</p>
						</center>
					</div>
					
					<div class="col-lg-3 p-2">
						<img src="img/iphone.jpg" width="100%">
						<center><br>
							<h5 style="color:#7971ea">Mobiles</b></h5>
							<p class="text-grey">Finding perfect products</p>
							<p style="color:#7971ea">Staring from PKR 100,000/-</p>
						</center>
					</div>
					
					<div class="col-lg-3 p-2">
						<img src="img/books.jpeg" width="100%">
						<center><br>
							<h5 style="color:#7971ea">Books</b></h5>
							<p class="text-grey">Finding perfect products</p>
							<p style="color:#7971ea">Staring from PKR 1000/-</p>
						</center>
					</div>
					
					<div class="col-lg-3 p-2">
						<img src="img/garments.jpg" width="100%">
						<center><br>
							<h5 style="color:#7971ea" class="mt-4">Accessories</b></h5>
							<p class="text-grey">Finding perfect products</p>
							<p style="color:#7971ea">Staring from PKR 500/-</p>
						</center>
					</div>
					

				</div>
			</div>
		</div>
		
		
		
		<!-- Sale  -->
		<div class="container mt-5">
			<center>
				<hr width="60" size="30" style="border-color:#7971ea">
				<h2>Big Sales!</h2>
			</center>
			
			<div class="row mt-5">
				<div class="col-lg-7 mt-2">
					<img src="img/ecom.jpg " class="img-thumbnail rounded"width="100%">
				</div>
				
				<div class="col-lg-5 mt-2">
					<center>
						<a href=""><h3 class="mt-5"> Upto 10% sale on all items</h3></a>
						<span class="text-dark">By</span><a href="index.html"> Shoppers</a> • <span>January 31, 2020</span><br><br>
						<span>Online Shoppers giving New Year big sales to all his customer</span><br>
						<span>where are user get 10%<sub> upto </sub>OFF on old items as well as customer</span><br>
						<span>get 10% <sub>upto</sub> OFF on new arrivasl using coupan code.</span><br><br>
						
						<a href="shop_items.php"><button class="btn btn-info btn-lg"><small>SHOP NOW</small></button></a>
					</center>
				</div>
				
			</div>
			<br><br><br>
		</div>
		
		<!-- Footer -->
		<?php include_once "includes/footer.php"; ?>
		
	</body>
</html>


<script>
	$(document).ready(function() {
		$('.services, .slider').hide();
		$('.services, .slider').fadeIn(1500);
	});
</script>

