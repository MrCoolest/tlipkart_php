<?php
session_start();
     $json = file_get_contents('./Json/context.json');

     //Decode JSON
     $json_data = json_decode($json,true);
     

$username = trim($json_data["context"]["Admin"]);
//echo $username;

if(isset($_SESSION['username']) && $_SESSION['username'] !== $username){
      header("location:./login_form.php");
      exit;
}

?>

<?php

require_once "./config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['id'];
echo $id;
// sql to Update a record

$sql = "UPDATE pet_posts SET Activate= 1 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
     header("location:./ushare.php");
} else {
     header("location:./ushare.php");
}

$conn->close();


?>