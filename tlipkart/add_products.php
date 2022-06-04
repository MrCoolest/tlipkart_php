<?php include './header.php' ?>


<?php
require_once "./config.php";
$submit = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $category = $_POST['Category'];
    $discription = $_POST['discription'];
    $temp = explode(".", $_FILES["img_file"]["name"]);
    $image = '_'.round(microtime(true)).'.' . end($temp);
    $img_tem_loc=$_FILES['img_file']['tmp_name'];
    $discription = $_POST['discription'];
    $img_store="./images/posts/".$image;

    move_uploaded_file($img_tem_loc,$img_store);
    $sql = "INSERT INTO `tlipkart`.`products` ( `name`, `price`, `category`, `description`, `image`) VALUES ('$name', '$price', '$category', '$discription', '$image');";

    if($conn -> query($sql)){
        $submit = "Submit Successfull!";
    }
    else{
        $submit = "Error : $sql <br> $conn->error";
    }

    // echo $submit;
    // Close the database conection     
$conn->close(); 
// header("location:./index.php");
header("Refresh:0");
exit;
}

?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

   
    <link rel="stylesheet" href="number.css">
 <style>
     *{
    
  font-size: 2rem;
}

input[type = "text"],
textarea{
    font-size: 2rem;
}




 </style>
  <body>
      <div class="container p-5 mb-4 bg-light border rounded-3 ">
          <form name="myform" action="" method="post" class="form-group " enctype="multipart/form-data">
              <h3 style="text-align: center; font-weight: bold;">Add Products</h3><br>
              <h3 style="text-align: center; font-weight: bold;"><?php echo $submit; ?></h3><br>

              <div class="row ">
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">Name</label>
                      <input type="text" class="form-control" name='Name' placeholder="First name" required><br>
                  </div><br>

                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">Price</label>
                      <input type="text" class="form-control" name='Price' placeholder="Price" required><br>
                  </div><br>
                


                 

                 
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputtype">Category</label>
                      <select class="form-select" id="sel1" name="Category">
                        <option disabled selected>-----</option>
                        <option value="Clothes">Clothes</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Jewellery">Jewellery</option>
                        <option value="Foot wear">Foot wear</option>
                        <option value="Cosmetics">Cosmetics</option>
                      </select><br>
                  </div><br>
                  <div class="col-md-6">
                      <label style="font-weight: bold;" for="inputname">Add picture</label>
                      <input class="form-control" type="file" name="img_file" id="formFile" accept="image/png, image/jpg, image/jpeg" required/>
                  </div><br>
                  <div class="mb-3 mt-3">
                    <label style="font-weight: bold;" for="comment">Discription</label>
                    <textarea class="form-control" rows="5" id="comment" name="discription" required></textarea>
                  </div>
                  <div class="col-md-12" style="text-align: center;">
                    <input type="submit" class="btn btn-primary" value='submit'>
                    
                  </div>
              </div>
          </form>
      </div>
    

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