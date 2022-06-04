<?php
require_once "./config.php";

$submit = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $number = $_POST['number'];
     $subject = $_POST['subject'];
     $msg = $_POST['msg'];

     $sql = "INSERT INTO `pet_website`.`queries` (`name`, `email`, `number`, `subject`,`message`, `date_time`) VALUES ('$name', '$email', '$number','$subject','$msg', current_timestamp());";

     if($conn -> query($sql)){
          $submit = "Submit Successfull!";
        }
        else{
          $submit = "Error : $sql <br> $con->error";
        }
        
}
// Close the database conection     
$conn->close(); 
header("location:./index.php");
exit;

?>

