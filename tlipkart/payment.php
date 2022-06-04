<?php

if((isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] != true){
    header("location:./login_form.php");
    exit;
}

?>

<?php

session_start();
     
require_once "./config.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    

$data['transaction'] = $_POST['transaction'];
$data['name'] = $_POST['name'];

    
echo json_encode($data);
$user = $user = intval($_SESSION['id']);
echo $user;
$sql = "SELECT * FROM cart WHERE customer = $user AND complete = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cart_id = (int)$row['id'];
        echo $cart_id;
    }
}

echo var_dump($GLOBALS);

$token = $data['transaction'];

$update_cart = "UPDATE `tlipkart`.`cart` SET `complete` = 1,`transaction` = $token WHERE `customer` = $user AND `id` = $cart_id;";

if(mysqli_query($conn, $update_cart)){
echo "update Successfull";
}      




}else{
$prev_url = $_SERVER['HTTP_REFERER'];
header("location:$prev_url");
}

?>

