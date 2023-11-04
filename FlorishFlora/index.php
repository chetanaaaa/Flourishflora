<?php 
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOURISH FLORA-Plantcare Management and Reminders</title>
    <!--bootsrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="style.css">
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
        <li class="nav-item">
          <a class="nav-link" href="#">total price:<?php total_cart_price();?>/-</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
        <!-- <button class="btn btn-outline-dark" type="submit">Search</button> -->
        <input type="submit" value="search" class="btn btn-outline-light" name="search_data_plant">
      </form>
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
  <div class="bg-light">
    <h3 class="text-center">FLOURISH FLORA</h3>
    <p class="text-center">Your Nursery's green companian</p>
  <!--fourth child-->
  <div class="row">
    <div class="col-md-10">
    <!--plants-->
    <div class="row px-1">
    <?php 
if(isset($_GET['search_data'])){
  search_plant();
}else{
  getplants();
}
get_unique_categories();

    ?>
 
 <!--row end-->
</div>
<!---column end-->
 </div>    


    <div class="col-md-2 bg-dark p-0">
      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-success">
          <a href="#" class="nav-link text-light"><h4>Categories</h4></a></li>
          <?php 
            getcategories();
          ?>
    
    

    <!--sidenav-->
</div>

</div>
    <!--bootsratp js -->
    <div class="bg-success p-3 text-center">
        <p>All rights reserved Designed by Nissy and Chets</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>