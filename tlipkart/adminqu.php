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

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
 
  <ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" href="adminqu.php">Querries</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="ushare.php">User Posts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="badminsub.php">Subscriptions</a>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="Index.php">Home</a>
    </li>
  </ul>
</div><br>

<div class="container mt-3">
  <h4>These are user querries</h4><br>
        
  <table class="table table-dark">
    <thead>
      <tr>
        <th>ID</th>  
        <th>Name</th>  
        <th>Email</th>  
        <th>Number</th>  
        <th>Subject</th>
        <th>Message</th> 
        <th>Date Time</th> 
      </tr>
    </thead>
    <tbody>
        <?php 
          require_once "./config.php";

          $sql = "SELECT id, name ,email, number, subject ,message,date_time FROM queries";
          
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
               echo '<tr>
                <th scope="row">'.$row["id"].'</th>
                <td>'. $row["name"].'</td>                
                <td>'. $row["email"].'</td>                
                <td>'. $row["number"].'</td>                
                <td>'. $row["subject"].'</td>                
                <td>'. $row["message"].'</td>                
                <td>'. $row["date_time"].'</td>                
                </tr>';
            }
          } 
          $conn->close();

        ?>
        </tbody>
  </table>
</div>
</body>
</html>
