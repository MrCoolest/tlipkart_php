

<?php

if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] != true){
    header("location:./login_form.php");
    exit;
}

session_start();
     
require_once "./config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['id'];
$cart_id =  $results['id_2'];
$user = intval($_SESSION['id']);



$sql = "DELETE FROM cart_item WHERE cart_id = $cart_id AND id = $id;";

if ($conn->query($sql)) {
     header("location:./cart.php");
}else{
     header("location:./cart.php");
}


?>