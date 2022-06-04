<?php include './header.php' ?>

<?php
      if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] != true){
        header("location:./login_form.php");
        exit;
    }
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


  @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
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

if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] == true){
  

     
require_once "./config.php";

$user = intval($_SESSION['id']);
$message = "";

$sql = "SELECT * FROM cart WHERE customer = $user AND complete = 0";
$cart_result = $conn->query($sql);


if ($cart_result->num_rows > 0) {
  while($row = $cart_result->fetch_assoc()) {
    $cart_id = $row['id'];
  $get_all_cart_items = "SELECT products.id as p_id, cart_item.id as c_id, products.price ,products.image, products.category ,products.name, cart_item.quantity FROM products JOIN cart_item ON product = products.id WHERE cart_id = $cart_id;";
$cart_items_result = $conn->query($get_all_cart_items);

  }
}else{
     $message = "Cart Is Empty";
}


}else{

  header("location:./login_form.php");
  exit();


}

$total_items = mysqli_num_rows($cart_items_result)

?>
<section class="h-100 h-custom" style="background-color: #f0f0f0;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?php echo "$total_items items"; ?></h6>
                  </div>
                  <hr class="my-4">

        

                  <?php
                  $total_price = 0;

    if ($cart_items_result->num_rows > 0) {
           while($row = $cart_items_result->fetch_assoc()) {
             echo '
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="./images/posts/'.$row['image'].'"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      <h6 class="text-muted">'.$row['category'].'</h6>
                      <h6 class="text-black mb-0">'.$row['name'].'</h6>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                    <button onclick="add_quantity('.$row['p_id'].')" class="btn_2 btn-dark">+</button>
                    <span class="bg-light px-3 py-3 text-dark">'.$row['quantity'].'</span>
                    <button onclick="remove_quantity('.$row['p_id'].')" class="btn_2 btn-dark">-</button>

                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0">$ '.$row['price'].'</h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="./delete_item.php?id='.$row['c_id'].'&id_2='.$cart_id.'" class="text-muted"><i class="fas fa-times"></i></a>
                    </div>
                  </div>
                  <hr class="my-4">
                  ';
            $total_price += ((int)$row['price'] * (int)$row['quantity']);

           }}else{
             echo '<div class="alert alert-secondary" role="alert">
             Your Cart is Empty !
           </div>';
           }
?>
                  


                  <div class="pt-5">
                    <h6 class="mb-0"><a href="./prod.php" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i> Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase"><?php echo "$total_items items"; ?></h5>
                    <h5><?php echo "$ $total_price"; ?></h5>
                  </div>

                  <!-- <h5 class="text-uppercase mb-3">Shipping</h5>

                  <div class="mb-4 pb-2">
                    <select class="select">
                      <option value="1">Standard-Delivery- €5.00</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                    </select> -->
                  <!-- </div> -->

                  <!-- <h5 class="text-uppercase mb-3">Give code</h5>

                  <div class="mb-5">
                    <div class="form-outline">
                      <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Enter your code</label>
                    </div>
                  </div> -->

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5><?php echo "$ $total_price"; ?></h5>
                  </div>

                  <button type="button" onclick="payment_page()" class="btn btn-dark btn-block btn-lg"
                    data-mdb-ripple-color="dark">Pay</button>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script>
    function add_quantity(id) {
      window.location.href = `./add_cart.php?id=${id}`;
    }
    function remove_quantity(id) {
      window.location.href = `./remove_cart.php?id=${id}`;
    }
    function payment_page() {
      window.location.href = `./payment_page.php`;
    }
  </script>


  </body>
  </html>