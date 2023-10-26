<?php 
include('includes/connect.php');
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
<!--css file--> 
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
          <a class="nav-link" href="#">Plants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reminders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" ><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">total price:100/-</a>
        </li>
        
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
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
  <div class="bg-light">
    <h3 class="text-center">FLOURISH FLORA</h3>
    <p class="text-center">Your Nursery's green companian</p>
  <!--fourth child-->
  <div class="row">
    <div class="col-md-10">
    <!--plants-->
    <div class="row">
      <div class="col-md-4 md-2">
      <div class="card">
      <img src="./images/tulip.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Tulip</h5>
    <h7 class="card-title">Bhavana Nursery</h5>
    <p class="card-text"></p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
    </div>
 
    <div class="col-md-4">
    <div class="card">
      <img src="./images/rose.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
    
</div>
<div class="col-md-4">
<div class="card">
      <img src="./images/white_lotus.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
</div>

      <div class="col-md-4 md-2">
      <div class="card">
      <img src="./images/champa.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
      </div>
      <div class="col-md-4 md-2">
      <div class="card">
      <img src="./images/hydrangea.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
      </div>
      <div class="col-md-4 md-2">
      <div class="card">
      <img src="./images/hibiscus.jpg" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-danger">Add to cart</a>
    <a href="#" class="btn btn-dark">View more</a>
</div>
</div>
 </div>    
</div>
</div>
     

    <div class="col-md-2 bg-dark p-0">
      <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-success">
          <a href="#" class="nav-link text-light"><h4>Categories</h4></a></li>
          <?php 
          $select_category="select * from categories";
          $result_category=mysqli_query($con,$select_category);
          while($row_data=mysqli_fetch_assoc($result_category))
          {
            $category_title=$row_data['category_title'];
            $category_id=$row_data['category_id'];
            echo"<li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-light m-3 '>$category_title</a>
            </li>";
          }
          
?>
    
    

    <!--sidenav-->
</div>

</div>
    <!--bootsratp js -->
    <div class="bg-success p-3 text-center">
        <p>All rights reserved Designed by Nisarga Kunder</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>