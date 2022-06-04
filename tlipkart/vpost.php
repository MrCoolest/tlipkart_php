<?php
// session_start(); 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
  header("location : ./index.php");
}
else{
require_once "./config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['page'];
// sql to delete a record
$sql = "SELECT * FROM pet_posts WHERE id= $id";
$result = $conn->query($sql);

$conn->close(); 
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>View Post</title>
<style>
 .img_edit{
   height: 500px;
 }
</style>
  </head>
  <body>
  <!-- display: block; height: 500px; margin-left: 25rem; margin-right: 20rem; width: 50% -->
 <?php 
  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
        echo'<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" >
            <div class="carousel-item active">
          <center>   <img src="./images/posts/'.$row["img"].'" class="img_edit" style="" alt="..."> </center>
            </div>
          </div>
       
        </div>
        <div class="row bg-light" style="margin-left: 2rem; margin-right: 2rem;">
            <div class="col-sm-7" style="margin-top: 5rem;">
              <div class="card ">
                <div class="card-body">
                
                  <h1 class="card-title" style="text-align: center;">Simon</h1><br><br>
                  <h3 class="card-title">About</h3><br>
                  <h5 class="card-title">Type</h5>
                  <p class="card-text">'. $row["Pet_type"].'</p>
                  <h5 class="card-title">category</h5>
                  <p class="card-text">'. $row["Category"].'.</p>
                  <h5 class="card-title">Breed</h5>
                  <p class="card-text">'. $row["Country"].'.</p>
                  <h5 class="card-title">Age</h5>
                  <p class="card-text">'. $row["Age"].'</p>
                  <h5 class="card-title">Age group</h5>
                  <p class="card-text">'. $row["Age_group"].'.</p>
                  <h5 class="card-title">Colour</h5>
                  <p class="card-text">'. $row["Colour"].'</p>
                  <h5 class="card-title">location</h5>
                  <p class="card-text">'. $row["State"].'.</p>
                  <h5 class="card-title">More Details</h5>
                  <p class="card-text">'. $row["Description"].'.</p>
                  
                </div>
              </div>
            </div>
            <div class="col-sm-5" style="margin-top: 5rem;">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title" style="text-align: center;">Seller Details</h3><br>
                  <h5 class="card-title">Name</h5>
                  <p class="card-text">'. $row["First_name"].' '.$row["Last_name"].'</p><br>
                  <h5 class="card-title">Email</h5>
                  <p class="card-text">'. $row["email"].'</p><br>
                  <h5 class="card-title">Contact no</h5>
                  <p class="card-text">'. $row["contact_no"].'</p><br>
                  <h5 class="card-title">Address</h5>
                  <p class="card-text">'. $row["Address"].'</p><br>
                  <h5 class="card-title">City</h5>
                  <p class="card-text">'. $row["city"].'</p><br>
                  <h5 class="card-title">State</h5>
                  <p class="card-text">'. $row["State"].'</p><br>
                  <h5 class="card-title">Country</h5>
                  <p class="card-text">'. $row["Country"].'a</p>
                 
                 
                 
                 
                 
                 
                 
                  
              </div>
            </div>
        </div>';
      }
    }
    ?>
     
  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>