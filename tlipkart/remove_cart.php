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
$user = intval($_SESSION['id']);

$prev_url = $_SERVER['HTTP_REFERER'];

$sql = "SELECT * FROM cart WHERE customer = $user AND complete = 0";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    //  header("location:./upost.php");
    while($row = $result->fetch_assoc()) {
        $cart_id = (int)$row['id'];
    
        $sql_2 = "SELECT * FROM cart_item WHERE cart_id = $cart_id AND product = $id";
         $result_2 = $conn->query($sql_2);
       
            
        if ($result_2->num_rows > 0) {

	    while($row_2 = $result_2->fetch_assoc()) {
            $prod_cart_id = (int)$row_2['id'];  
            $quant = (int)$row_2['quantity'];  
   

            if($quant > 1){
                $quant-=1;

                $update_cart_item = "UPDATE `tlipkart`.`cart_item` SET `quantity` = $quant WHERE `product` = $id AND `cart_id` = $cart_id;";
                if(mysqli_query($conn, $update_cart_item)){
                //  header("location:./view_prod.php?id=$id");
                 header("location:$prev_url");

                }      
             
            }else{
                $delete_cart_item = "DELETE FROM `cart_item` WHERE `product` = $id AND `cart_id` = $cart_id;";
                if(mysqli_query($conn, $delete_cart_item)){
                    // header("location:./view_prod.php?id=$id");
                    header("location:$prev_url");
                   }  
            }

       
    }

}

    }
}





?>