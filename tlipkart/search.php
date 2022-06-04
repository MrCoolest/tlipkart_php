<?php
require_once "./config.php";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
$query = $_GET['search'];
// echo $query;
$sql = "SELECT * FROM pet_posts WHERE ((`Category` LIKE '%".$query."%') OR (`First_name` LIKE '%".$query."%') OR (`city` LIKE '%".$query."%') OR (`Last_name` LIKE '%".$query."%') OR (`State` LIKE '%".$query."%') OR (`Country` LIKE '%".$query."%') OR (`Pet_type` LIKE '%".$query."%') OR (`Bread` LIKE '%".$query."%')) AND ( Activate = 1)";

$result = $conn->query($sql);


}


   session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet adoption website</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">
    <style>
        .login-btn{
            Color : white;
            font-size : 2rem;
            border-radius: .5rem;
            padding:.5rem 1.5rem;
        }
        .login-btn:hover{
            background:blue;
            color:white;
        }
        .logout-btn{
            Color : white;
            font-size : 2rem;
            border-radius: .5rem;
            padding:.5rem 1.5rem;
        }
        .logout-btn:hover{
            background:red;
            color:white;
        }
        .search{
            padding:1rem;
            border:1px solid rgba(0,0,0,.3);
            background-color: white;
        }
        .img-size{
          width: 100%;
          height : 500px;
        }

        .head-size{
          font-size:5rem;
        }
        .desc-size{
          font-size: 2rem;
        }
        a{
          text-decoration:none;
        }
        
        @media (max-width: 768px){
        .header-2 .navbar.active{
          z-index: 99;
        }

      }
        </style>
</head>
<body>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <a href="./index.php" class="logo"><i class="fas fa-adoption"></i>adoptme</a>

        <form action="./search.php" class="search-box-container" method="">
            <input type="search" name='search' id="search-box" placeholder="Search for pets..." required>
            <button type="submit" for="search-box" class="fas fa-search search"></button>
        </form>

    </div>

    <div class="header-2">

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="./index.php">HOME</a>
            
            <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
              {
            echo '<a href="bttadd.php">ADD PETS</a>';
        }
        ?>
  <?php
     $json = file_get_contents('./Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     

$username = trim($json_data["context"]["Admin"]);
//echo $username;

if(isset($_SESSION['username']) && $_SESSION['username'] === $username){
   echo '<a href="adminqu.php">ADMIN</a>';
  
}

?>
        </nav>
    

        <div class="icons">
            
            <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
              {
                echo '<a href="./logout.php" id=""  class="logout-btn">Logout</a>';
                echo '<a href="#"><div id="like-btn" class="fas fa-user-circle"></div></a>';
                echo '      <div class="heart">
                <div class="box">
                    
                    
                    <div class="content">
                        <h3>'.$_SESSION["name"].'</h3>
                        <h3>'.$_SESSION["username"].'</h3>
                         <a href=""><h3>My posts</h3></a>
                        
                        
                    </div>
                </div>
                
            </div>';
              }else{
               echo '<a href="./login_form.php" id=" "  class="login-btn">Login</a>';
              }
              ?>
               
        </div>

  



        
    </div>
    

</header>

<!-- header section ends -->


<!-- Main Result Section -->

<section class="search_result">
  <div class="container py-3">
<?php
// 
//      // output data of each row
//      while($row = $result->fetch_assoc()) {
//        echo "id: " . $row["id"]. " - Name: " . $row["First_name"]. " " . $row["Last_name"]. "<br>";
//      }
//    }else{
//         echo "not";
//    }
if ($result->num_rows > 0) {
   // output data of each row
     while($row = $result->fetch_assoc()) {
   echo '<div class="card mb-3">
        <img class="card-img-top img-size" src="./images/posts/'.$row["img"].'" alt="'.$row["Pet_Name"].'">
        <div class="card-body">
          <h1 class="card-title head-size">'.$row["Pet_Name"].'</h1>';

          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
          {
             echo '<a href="./vpost.php?page='.$row["id"].'" class="btn btn-primary">View Details</a>';
          }else{
             echo '<a href="./login_form.php" class="btn btn-primary">View Details</a>';
          }   
     

          
       echo '</div>
        </div>';
     }
}else{
          echo '<div class="alert alert-secondary" role="alert">
          <h2 class="card-title head-size">   No Results Are Found! </h2>
        </div>';
     }


     
?>

  </div>
</section>



</body>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<!-- custom js file link  -->
<script src="script.js"></script>
</html>
