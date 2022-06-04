<?php 
require_once "./config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email =  trim($_POST['sub_email']);
$sql = "INSERT INTO `pet_website`.`subsribers` (`email`) VALUES ('$email');";



if($conn -> query($sql)){
     $submit = "Submit Successfull!";
   }
   else{
     $submit = "Error : $sql <br> $con->error";
   }
   
   // Close the database conection
   $conn->close();  
   header("location:./index.php");

}


?>   