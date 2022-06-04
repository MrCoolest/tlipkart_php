<?php include './header.php' ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Product List Carousel for Ecommerce Website</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	font-family: "Open Sans", sans-serif;
}
h2 {
	color: #000;
	font-size: 26px;
	font-weight: 300;
	text-align: center;
	text-transform: uppercase;
	position: relative;
	margin: 30px 0 80px;
}
h2 b {
	color: #ffc000;
}
h2::after {
	content: "";
	width: 100px;
	position: absolute;
	margin: 0 auto;
	height: 4px;
	background: rgba(0, 0, 0, 0.2);
	left: 0;
	right: 0;
	bottom: -20px;
}
.carousel {
	margin: 50px auto;
	padding: 0 70px;
}
.carousel .carousel-item {
	min-height: 330px;
	text-align: center;
	overflow: hidden;
}
.carousel .carousel-item .img-box {
	height: 160px;
	width: 100%;
	position: relative;
}
.carousel .carousel-item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .carousel-item h4 {
	font-size: 18px;
	margin: 10px 0;
}
.carousel .carousel-item .btn {
	color: #333;
	border-radius: 0;
	font-size: 11px;
	text-transform: uppercase;
	font-weight: bold;
	background: none;
	border: 1px solid #ccc;
	padding: 5px 10px;
	margin-top: 5px;
	line-height: 16px;
}
.carousel .carousel-item .btn:hover, .carousel .carousel-item .btn:focus {
	color: #fff;
	background: #000;
	border-color: #000;
	box-shadow: none;
}
.carousel .carousel-item .btn i {
	font-size: 14px;
	font-weight: bold;
	margin-left: 5px;
}
.carousel .thumb-wrapper {
	text-align: center;
}
.carousel .thumb-content {
	padding: 15px;
}
.carousel-control-prev, .carousel-control-next {
	height: 100px;
	width: 40px;
	background: none;
	margin: auto 0;
	background: rgba(0, 0, 0, 0.2);
}
.carousel-control-prev i, .carousel-control-next i {
	font-size: 30px;
	position: absolute;
	top: 50%;
	display: inline-block;
	margin: -16px 0 0 0;
	z-index: 5;
	left: 0;
	right: 0;
	color: rgba(0, 0, 0, 0.8);
	text-shadow: none;
	font-weight: bold;
}
.carousel-control-prev i {
	margin-left: -3px;
}
.carousel-control-next i {
	margin-right: -3px;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}
.carousel .item-price strike {
	color: #999;
	margin-right: 5px;
}
.carousel .item-price span {
	color: #86bd57;
	font-size: 110%;
}	
.carousel .carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border-color: transparent;
	border: none;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
</style>
</head>
<body>

<?php
        require_once "./config.php";

        $sql = "SELECT id, name, price, image , category,description FROM products";
        
        $result = $conn->query($sql);

		$total_row = ceil(mysqli_num_rows($result) / 4);  

?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>Trending <b>Products</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
		
			<?php

			for($i=0 ; $i<$total_row ; $i++){
				if($i == 0){
					echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
				}else{
					echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
				}
			}

		?>		
			</ol>   
			
			<!-- Wrapper for carousel items -->

			<?php
	echo '<div class="carousel-inner">';

$count = 0;

if ($result->num_rows > 0) {
	// output data of each row

	while($row = $result->fetch_assoc()) {
		

		

		if($count % 4 == 0){
			if($count == 0){
				echo '
				<div class="carousel-item active">
				<div class="row">
				';
			}else{
				echo '<div class="carousel-item">
				<div class="row">
				';
			}
		}

		echo '<div class="col-sm-3">
		<div class="thumb-wrapper">
			<div class="img-box">
				<img src="./images/posts/'.$row['image'].'" class="img-fluid" alt="">
			</div>
			<div class="thumb-content">
				<h4>'.$row['name'].'</h4>
				<p class="item-price"><strike>$'.$row['price'].'</strike> <span>$369.00</span></p>
				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
					</ul>
				</div>
				<a href="./view_prod.php?id='.$row["id"].'" class="btn btn-primary">View</a>
			</div>						
		</div>
	</div>';

	if(($count+1) % 4 == 0){
		echo'
		</div>
		</div>';
		}


	$count++;



	
	}}	


	if(($count) % 4 != 0){
		echo'
		</div>
		</div>';
		}

echo "</div>";


?>

			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</div>




<!-- 2nd -->

<div class="container"> 


	<div class="row">
		<div class="col-md-12">
			<h2>Electronics</b></h2>
			<div id="myCarouse2" class="carousel slide" data-ride="carouse2" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
		
			<?php

			for($i=0 ; $i<$total_row ; $i++){
				if($i == 0){
					echo '<li data-target="#myCarouse2" data-slide-to="'.$i.'" class="active"></li>';
				}else{
					echo '<li data-target="#myCarouse2" data-slide-to="'.$i.'"></li>';
				}
			}

		?>		
			</ol>   
			
			<!-- Wrapper for carousel items -->

			<?php

require_once "./config.php";

        $sql = "SELECT id, name, price, image , category,description FROM products WHERE category = 'Electronics'";

$result = $conn->query($sql);

$total_row = ceil(mysqli_num_rows($result) / 4);  
	echo '<div class="carousel-inner">';

$count = 0;

if ($result->num_rows > 0) {
	// output data of each row



	while($row = $result->fetch_assoc()) {
		

		

		if($count % 4 == 0){
			if($count == 0){
				echo '
				<div class="carousel-item active">
				<div class="row">
				';
			}else{
				echo '<div class="carousel-item">
				<div class="row">
				';
			}
		}

		echo '<div class="col-sm-3">
		<div class="thumb-wrapper">
			<div class="img-box">
				<img src="./images/posts/'.$row['image'].'" class="img-fluid" alt="">
			</div>
			<div class="thumb-content">
				<h4>'.$row['name'].'</h4>
				<p class="item-price"><strike>$'.$row['price'].'</strike> <span>$369.00</span></p>
				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star"></i></li>
						<li class="list-inline-item"><i class="fa fa-star-o"></i></li>
					</ul>
				</div>
				<a href="./view_prod.php?id='.$row["id"].'" class="btn btn-primary">View</a>
			</div>						
		</div>
	</div>';

	if(($count+1) % 4 == 0){
		echo'
		</div>
		</div>';
		}


	$count++;



	
	}}	


	if(($count) % 4 != 0){
		echo'
		</div>
		</div>';
		}

echo "</div>";


?>

			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarouse2" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarouse2" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</div>
</body>
</html>                                		