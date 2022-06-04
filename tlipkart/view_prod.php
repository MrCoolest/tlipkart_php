<?php include './header.php' ?>

<?php
     
require_once "./config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['id'];

$sql = "SELECT * FROM products WHERE id=$id";
$result = $conn->query($sql);



?>
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Open+Sans"
/>
<link
  rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
/>
<link
  rel="stylesheet"
  href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
/>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
  body {
    /* background-color: #ecedee; */
    font-size:2rem;
  }

  .card {
    border: none;
    overflow: hidden;
  }

  .thumbnail_images ul {
    list-style: none;
    justify-content: center;
    display: flex;
    align-items: center;
    margin-top: 10px;
  }

  .thumbnail_images ul li {
    margin: 5px;
    padding: 10px;
    border: 2px solid #eee;
    cursor: pointer;
    transition: all 0.5s;
  }

  .thumbnail_images ul li:hover {
    border: 2px solid #000;
  }

  .main_image {
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 1px solid #eee;
    height: 400px;
    width: 100%;
    overflow: hidden;
  }

  .heart {
    height: 29px;
    width: 29px;
    background-color: #eaeaea;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .content p {
    font-size: 12px;
  }

  .ratings span {
    font-size: 14px;
    margin-left: 12px;
  }

  .colors {
    margin-top: 5px;
  }

  .colors ul {
    list-style: none;
    display: flex;
    padding-left: 0px;
  }

  .colors ul li {
    height: 20px;
    width: 20px;
    display: flex;
    border-radius: 50%;
    margin-right: 10px;
    cursor: pointer;
  }

  .colors ul li:nth-child(1) {
    background-color: #6c704d;
  }

  .colors ul li:nth-child(2) {
    background-color: #96918b;
  }

  .colors ul li:nth-child(3) {
    background-color: #68778e;
  }

  .colors ul li:nth-child(4) {
    background-color: #263f55;
  }

  .colors ul li:nth-child(5) {
    background-color: black;
  }

  .right-side {
    position: relative;
  }

  .search-option {
    position: absolute;
    background-color: #000;
    overflow: hidden;
    align-items: center;
    color: #fff;
    width: 200px;
    height: 200px;
    border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
    left: 30%;
    bottom: -250px;
    transition: all 0.5s;
    cursor: pointer;
  }

  .search-option .first-search {
    position: absolute;
    top: 20px;
    left: 90px;
    font-size: 20px;
    opacity: 1000;
  }

  .search-option .inputs {
    opacity: 0;
    transition: all 0.5s ease;
    transition-delay: 0.5s;
    position: relative;
  }

  .search-option .inputs input {
    position: absolute;
    top: 200px;
    left: 30px;
    padding-left: 20px;
    background-color: transparent;
    width: 300px;
    border: none;
    color: #fff;
    border-bottom: 1px solid #eee;
    transition: all 0.5s;
    z-index: 10;
  }

  .search-option .inputs input:focus {
    box-shadow: none;
    outline: none;
    z-index: 10;
  }

  .search-option:hover {
    border-radius: 0px;
    width: 100%;
    left: 0px;
  }

  .search-option:hover .inputs {
    opacity: 1;
  }

  .search-option:hover .first-search {
    left: 27px;
    top: 25px;
    font-size: 15px;
  }

  .search-option:hover .inputs input {
    top: 20px;
  }

  .search-option .share {
    position: absolute;
    right: 20px;
    top: 22px;
  }

  .buttons .btn {
    height: 50px;
    width: 150px;
    border-radius: 0px !important;
  }
  .btn_2 {
    height: 50px;
    width: 5rem;
    border-radius: 0px !important;
    outline : none;
  }

  .btn_2:active {
outline: none;
border: none;
}
</style>


<?php
  $user = intval($_SESSION['id']);
  $total_prod = 0;
  $get_cart = "SELECT * FROM cart WHERE customer=$user AND complete = 0";
  $cart_result = $conn->query($get_cart);

if ($cart_result->num_rows > 0) {
  while($row = $cart_result->fetch_assoc()) {
    $cart_id = $row['id'];
  $get_cart_item = "SELECT * FROM cart_item WHERE cart_id=$cart_id AND product = $id";
  $cart_item_result = $conn->query($get_cart_item);

      if ($cart_item_result->num_rows > 0) {

  while($row_2 = $cart_item_result->fetch_assoc()) {
    $total_prod = $row_2['quantity'];
}

  }

}

}



  
?>

<div class="container mt-5 mb-5">
  <div class="card">
    <div class="row g-0">
  <?php    
if ($result->num_rows > 0) {
	// output data of each row

	while($row = $result->fetch_assoc()) {
		
    echo '<div class="col-md-6 border-end">
        <div class="d-flex flex-column justify-content-center">
          <div class="main_image">
            <img
              src="./images/posts/'.$row['image'].'"
              id="main_product_image"
              width="350"
            />
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="p-3 right-side">
          <div class="d-flex justify-content-between align-items-center">
            <h3>'.$row['name'].'</h3>
          </div>
          <div class="mt-2 pr-3 content">
            <p>
            '.$row['description'].'
            </p>
          </div>
          <h3>$'.$row['price'].'</h3>
          <div class="ratings d-flex flex-row align-items-center">
            <div class="d-flex flex-row">
              <i class="bx bxs-star"></i> <i class="bx bxs-star"></i>
              <i class="bx bxs-star"></i> <i class="bx bxs-star"></i>
              <i class="bx bx-star"></i>
            </div>
            <span>441 reviews</span>
          </div>
    
          <div class="buttons d-flex flex-row mt-5 gap-3">';

          if($total_prod > 0){
            echo '<button onclick="add_quantity('.$row['id'].')" class="btn_2 btn-dark">+</button>
            <span class="bg-light px-3 py-3 text-dark">'.$total_prod.'</span>
            <button onclick="remove_quantity('.$row['id'].')" class="btn_2 btn-dark">-</button>';
          }else{
      echo  '<button class="btn btn-outline-dark">Buy Now</button>
          <button onclick="add_quantity('.$row['id'].')" class="btn btn-dark">Add to Cart</button>';
        }

       echo '</div>
        
        </div>
      </div>';
  }}
  

?>

    </div>
  </div>
</div>

  <script>
    function add_quantity(id) {
      window.location.href = `./add_cart.php?id=${id}`;
    }
    function remove_quantity(id) {
      window.location.href = `./remove_cart.php?id=${id}`;
    }
  </script>

</body>
</html>