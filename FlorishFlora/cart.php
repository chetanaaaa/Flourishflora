<?php 
include('includes/connect.php');
include('functions/common_function.php');
@session_start();
?>
<?php
$get_ip_address=$_SERVER['REMOTE_ADDR'];
if(isset($_POST['update'])){
  $quantities=intval($_POST['qty']);
  $id=$_POST['update_quantity'];
  $updateq="update cart_details set quantity=$quantities where plant_id=$id and ip_address='$get_ip_address'";
  $result=mysqli_query($con,$updateq);
  if($result){
    header('location:cart.php');
  }
}
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
if(isset($_SESSION['email'])){
  $email=$_SESSION['email'];
  $selectq="select * from user_table where email='$email'";
  $user_res=mysqli_query($con,$selectq);
  $user_row=mysqli_fetch_array($user_res);
  $fname=$user_row['fname'];
  }
?>

<!-- second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<ul class="navbar-nav me-auto">
<?php
        if(!isset($_SESSION['email'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
          </li>";
        }
        else{
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome $fname</a>
          </li>";}
    if(!isset($_SESSION['email'])){
      echo "<li class='nav-item'>
      <a class='nav-link' href='./user/login.php'>Login</a>
      </li>";
    }
    else{
      echo "<li class='nav-item'>
      <a class='nav-link' href='./user/logout.php'>Logout</a>
      </li>";
    }
    ?>
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

<?php
global $con;
$get_ip_address=$_SERVER['REMOTE_ADDR'];
$total=0;
$grand_total=0;
$cart_query="select * from cart_details where ip_address='$get_ip_address'";
$resultq=mysqli_query($con,$cart_query);
$count=mysqli_num_rows($resultq);
if($count>0){
  echo "<thead>
  <tr>
      <th>Plant Name</th>
      <th>Image</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Remove</th>
      <th>Operations</th>
      <th>Total price</th>
  </tr>
</thead>";
while($row=mysqli_fetch_array($resultq)){
    $qty=$row['quantity'];
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
<td> <input type='number' name='qty' min='1' class='text-center' value=<?php echo $qty?>></td>
                    
                    <td><?php echo number_format($price)?></td>
                    <td><input type="checkbox" name="removeitem[]" value="<?php echo $plant_id ?>"></td>
                    
                    <td>
                        <input type="hidden" value="<?php echo $plant_id?>" name=update_quantity>
                        <input type="submit" value="Update" class="bg-success px-3 py-0.5 border-0 mx-4" name="update">
                        <input type="submit" value="Remove" class="bg-danger px-3 py-0.5 border-0 mx-4" name="remove">
                    </td>
                    <td><?php echo $subtotal=number_format($rowp['price']*$row['quantity'])?></td>
</form>
                </tr>
<?php  
$grand_total+=$rowp['price']*$row['quantity'];
$grand_total_format=number_format($grand_total);
}}}
else{
  echo "<h2 class='text-center text-danger'>Your cart is empty:\</h2>";
}
?>
            </tbody>
        </table>
<div class="d-flex mb-5">
<?php
$get_ip_address=$_SERVER['REMOTE_ADDR'];
$cart_query="select * from cart_details where ip_address='$get_ip_address'";
$resultq=mysqli_query($con,$cart_query);
$count=mysqli_num_rows($resultq);
if($count>0){
echo "<h4 class='px-3'>Grand Total: <strong class='text-success'>$grand_total_format/-</strong></h4>
<input type='submit' name='continue' value='Continue Shopping' class='bg-success px-3 py-3 border-0 mx-4'>
<button class='bg-secondary px-3 py-2 border-0'><a href='./user/checkout.php' class='text-decoration-none text-light'>Checkout</a></button>";
}else{
  echo "<input type='submit' name='continue' value='Continue Shopping' class='bg-success px-3 py-3 border-0 mx-4'>";
}
if(isset($_POST['continue'])){
  echo "<script>window.open('index.php','_self')</script>";
}
?>
</div>
</div>
</div>

<?php
function remove_cart_item(){
    global $con;
    if(isset($_POST['remove'])){
      if(isset($_POST['removeitem'])){
        foreach($_POST['removeitem'] as $remove_id){
            echo $remove_id;
            $delete_query="delete from cart_details where plant_id=$remove_id";
            $run_del=mysqli_query($con,$delete_query);
            if($run_del){
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }else{
      echo "<script>alert('To remove an item, use the checkbox.')</script>";
    }
}
}
echo $remove_item=remove_cart_item();
?>



    <!--bootsratp js footer -->
    <div class="bg-success p-3 text-center">
        <p>All rights reserved Designed by Nissy and Chets</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>