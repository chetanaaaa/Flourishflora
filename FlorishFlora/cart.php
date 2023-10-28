<?php 
include('includes/connect.php');
include('functions/common_function.php');
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOURISH FLORA CART-Plantcare Management and Reminders</title>
    <!--bootsrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="style.css">
 <style>
    .cart_img{
        width:70px;
        height:70px;
        object-fit:contain;
    }
 </style>
</head>
 <body>
    <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
   <img src="./images/plant_logo.png" class="logo"> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./user/registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Plants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reminders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php" ><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
cart();
?>

<!-- second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<ul class="navbar-nav me-auto">
  <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
 <li class="nav-item">
          <a class="nav-link" href="./user/login.php">Login</a>
        </li>
</ul>
</nav>
<!-- Third child -->
  <div class="bg-light">
    <h3 class="text-center">FLOURISH FLORA </h3>
    <h6 class="text-center">CART Details</h6>
  
</div>

<!-- fourth child -->
<form action="" method="post">
<div class="container">
    <div class="row">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Plant Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Remove</th>
                    <th>Operations</th>
                </tr>
            </thead>
<?php
global $con;
$get_ip_address=$_SERVER['REMOTE_ADDR'];
$total=0;
$cart_query="select * from cart_details where ip_address='$get_ip_address'";
$resultq=mysqli_query($con,$cart_query);
while($row=mysqli_fetch_array($resultq)){
  $plant_id=$row['plant_id'];
  $select_plants="select * from plants where plant_id=$plant_id";
  $result_plant=mysqli_query($con,$select_plants);
  while($rowp=mysqli_fetch_array($result_plant)){
    $name=$rowp['plant_name'];
    $price=$rowp['price'];
    $image=$rowp['image'];
    $price_arr=array($rowp['price']);
    $values=array_sum($price_arr);
    $total+=$values;
?>
            <tbody>
                <tr>
                    <td><?php echo $name?></td>
                    <td><img class="cart_img" src="./images/<?php echo $image?>" alt=""></td>
<form action="" method="post">
                    <td><input type="number" name="qty" min="1" class="form-input w-10"></td>
                    <?php
                     $get_ip_address=$_SERVER['REMOTE_ADDR'];
                    if(isset($_POST['update'])){
                        $quantities=intval($_POST['qty']);
                        $id=$_POST['update_quantity'];
                        $update="update cart_details set quantity=$quantities where plant_id=$id and ip_address='$get_ip_address'";
                        $result=mysqli_query($con,$update);
                        $total=$total+$quantities*$price;
                    }
                    ?>
                    <td><?php echo $price?></td>
                    <td><input type="checkbox"></td>
                    <td>
                        <input type="hidden" value="<?php echo $plant_id?>" name=update_quantity>
                        <input type="submit" value="Update" class="bg-success px-3 py-0.5 border-0 mx-4" name="update">
                        <button class="bg-danger px-3 py-0.5 border-0 mx-1">Remove</button>
                    </td>
</form>
                </tr>
<?php  }}?>
            </tbody>
        </table>
<div class="d-flex mb-5">
<h4 class="px-3">Subtotal: <strong class="text-success"><?php echo $total ?>/-</strong></h4>
<a href="index.php"><button class="bg-success px-3 py-2 border-0 mx-3">Continue Shopping</button></a>
<a href="#"><button class="bg-secondary px-3 py-2 border-0 text-light">Checkout</button></a>
</div>
</div>
</div>



    <!--bootsratp js footer -->
    <div class="bg-success p-3 text-center">
        <p>All rights reserved Designed by Nissy and Chets</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>