

<?php


// This Script is to Handel to Login

session_start();

// If The user is Already login

if(isset($_SESSION['username'])){
     header("location:./index.php");
     exit;
}
require_once "./config.php";

$username = $password = "";
$err = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
     if(empty(trim($_POST["email"])) || empty(trim($_POST["passwd"])) ){
          $err = "Please Enter Email and Password";
     }
     else{
          $username =  trim($_POST["email"]);
          $password =  trim($_POST["passwd"]);
          
     }

     if(empty($err)){
          $sql = "SELECT id, name , email, password FROM user_form WHERE email = ?";
          $stmt = mysqli_prepare($conn, $sql);

          mysqli_stmt_bind_param($stmt, 's', $param_email);
          $param_email = $username;
          if(mysqli_stmt_execute($stmt)){
               mysqli_stmt_store_result($stmt);
               if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $name ,$email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                      
                         if(md5($password) == $hashed_password){
                              //This means the password is correct
                              session_start();
                              $_SESSION["username"] = $email; 
                              $_SESSION["id"] = $id; 
                              $_SESSION["name"] = $name; 
                              $_SESSION["loggedin"] = true; 

                              //Redirect to user the welcome page
                              header("location: ./index.php");
                              
                         } 
                         else{
                              // /header("location:./login.php");
                              $err = "Email-id & Password is not Matching!";
                    }
                    }
               }
               else{
                   // header("location:./login.php");
                   $err = "User is not Registered!";

          }
          }

     }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="fstyle.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <h4><?php echo $err; ?></h4>
      
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="passwd" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>

</div>

</body>
</html>