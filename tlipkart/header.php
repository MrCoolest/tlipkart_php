<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TlipKart</title>

    <!-- font awesome cdn link  -->
`<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="header.css">
    <style>
        .login-btn{
            Color : rgb(28, 28, 28);
            font-size : 2rem;
            border-radius: .5rem;
            padding:.5rem 1.5rem;
        }
        .login-btn:hover{
            background:rgb(28, 28, 28);
            color:white;
        }
        .logout-btn{
            Color : rgb(28, 28, 28);
            font-size : 2rem;
            border-radius: .5rem;
            padding:.5rem 1.5rem;
        }
        .logout-btn:hover{
            background:rgb(28, 28, 28);
            color:white;
        }
        .Cart-btn{
            Color : rgb(28, 28, 28);
            font-size : 2rem;
            border-radius: .5rem;
            padding:.5rem 1.5rem;
        }
        .Cart-btn:hover{
            background:rgb(28, 28, 28);
            color:white;
        }
        .search{
            padding:1rem;
            border:1px solid rgba(0,0,0,.3);
            background-color:white;
            cursor: pointer;
        }
        .posts .box-container .box {
            width: 330px !important; 
            flex: none;
        }

        @media (max-width: 768px){
            .posts .box-container .box {
            width: 330px !important; 
            flex: none;
        }
        }
        
        </style>
</head>
<body>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <a href="./index.php" class="logo"><i class="fas fa-adoption"></i>TLIPKART</a>

        <form action="./search.php" class="search-box-container" method="">
            <input type="search" name='search' id="search-box" placeholder="Search for products..." required>
            <button type=”submit” for="search-box" class="fas fa-search search"></button>
        </form>

    </div>

    <div class="header-2">

        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="#home">HOME</a>
            <a href="#deal">ABOUT US</a>
            <a href="#posts">EXPLORE</a>
            <a href="#contact">CONTACT US</a>
            <a href="./prod.php">PRODUCTS</a>
        
<?php
     $json = file_get_contents('./Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     

$username = trim($json_data["context"]["Admin"]);
//echo $username;

if(isset($_SESSION['username']) && $_SESSION['username'] === $username){
    echo '<a href="add_products.php">ADD Prod</a>';
   echo '<a href="adminqu.php">ADMIN</a>';
  
}

?>
        </nav>
        </nav>

        <div class="icons">
            
            <?php
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
              {
                echo '<a href="./logout.php" id=""  class="logout-btn">Logout</a>';
                echo '<a href="./upost.php" id=""  class="logout-btn">My Orders</a>';
                echo '<a href="./cart.php" id=""  class="Cart-btn"><i class="fa-solid fa-cart-shopping"></i></a>';
                echo '<a href="./upersonal.php"><div id="like-btn" class="fa-solid fa-circle-user""></div></a>';
                
              }else{
               echo '<a href="./login_form.php" id=" "  class="login-btn">Login</a>';
              }
              ?>
               
        </div>

  



        
    </div>
</header>
