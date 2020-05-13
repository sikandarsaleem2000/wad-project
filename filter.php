<?php
    include_once "includes/links.php";
    include_once "includes/connection.php";

    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Shoppers | Filters</title>
	</head>

	<body  style="background:#e6e6e6;">
        <div class="container-fluid  animation">
			<div class="row pb-3 bg-light">
				<div class="container"><br>
				<p><a href="index.php" class="my-auto">Home  </a> / Search By Filters</p>
				</div>
			</div>
        </div>

		<div class="container mt-5">
                <div class="row ">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6 bg-light p-4" style="border-left:5px solid lightblue">
                        <form method="GET"  action="search_items_by_filter.php">
                            <center><h3 class="font-weight-normal">Search Product's by Filters</h3></center>
                            <hr/>
                            <label for="name"> Product Name</label>
                            <input type="text"  class="form-control" name="name" id="name" placeholder="Enter Product Name" required>

                            <label class="mt-2" for="city"> Location</label>
                            <input class="form-control" name="city" id="city" type="text" placeholder="Location" required >
                            
							<select name="price_option" class="form-control mt-4">
								<option value="htl" selected>Price High to Low</option>
								<option value="lth">Price Low to High</option>
							</select>
                            <div class="form-inline">
							<label class="mt-3" for="city"> Price Range &nbsp;&nbsp; </label> 
							    <input class="form-control mt-4" MIN = "1" name="min" id="min" type="number" placeholder="MIN" required>
                                <input class="form-control ml-4 mt-4" MIN = "1" name="max" id="max" type="number" placeholder="MAX" required>
                            </div>
                            
                            

                            <button class="btn btn-info mt-4" name="search_btn" id="search_btn">Search Product</button>
                        </form>
                    </div>
                </div>
            </div>
		</div>


	</body>
</html>



