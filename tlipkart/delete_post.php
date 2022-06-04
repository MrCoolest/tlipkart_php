<?php
session_start();
     
require_once "./config.php";

$url = $_SERVER['REQUEST_URI'];
$components = parse_url($url);
parse_str($components['query'], $results);
$id =  $results['id'];
echo $id;

$sql = "DELETE FROM pet_posts WHERE id=$id";

if ($conn->query($sql) === False) {
     header("location:./upost.php");
}else{
     header("location:./upost.php");
}


?>