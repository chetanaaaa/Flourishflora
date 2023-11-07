<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
if(isset($_SESSION['name']))
{
$name=$_SESSION['name'];
$selectq="select * from nursery where name='$name'";
$user_res=mysqli_query($con,$selectq);
$user_row=mysqli_fetch_array($user_res);
$name=$user_row['name'];
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="../style.css">
<style>
    .product_img{
    width:100%;
    height:5vw;
    object-fit:cover;
}
</style>

</head>

<body>

<div class="container-fluid p-0">
        <!--firstchild-->
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid">
                <img src="../images/plant_logo.png" alt="" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                    <?php
                   if(!isset($_SESSION['name'])){
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                    </li>";
                  }
                  else{
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome $name</a>
                    </li>";} 

                    if(!isset($_SESSION['name'])){
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='nursery_login.php'>Login</a>
                        </li>";
                      }
                      else{
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='logout.php'>Logout</a>
                        </li>";
                      }

                    ?>
</ul>
</nav>

</div>

        </nav>
<!--second child-->
<div class="bg-light">
    <h3 class="text-center">Manage Details</h3>
    </div>
<!--third child-->
<div class="row">
    <div class="col-md-12 bg-dark p-1 align-items-center">
<div class="button text-center">
    <button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-success ">Insert products</a></button>
    <button><a href="index.php?view_plants" class="nav-link text-light bg-success">View Products</a></button>
    <button><a href="index.php?list_orders" class="nav-link text-light bg-success">Orders</a></button> 
    <button><a href="" class="nav-link text-light bg-success">Payment</a></button>
    <button><a href="index.php?sales" class="nav-link text-light bg-success">Toatal Sales</a></button>
</div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
if(isset($_GET['view_plants']))
    {
        include('view_plants.php');
    }
    if(isset($_GET['edit_plants']))
    {
        include('edit_plants.php');
    }
    if(isset($_GET['remove_plants']))
    {
        include('remove_plants.php');
    }
    if(isset($_GET['list_orders']))
    {
        include('list_orders.php');
    }
    if(isset($_GET['sales']))
    {
        include('sales.php');
    }
    ?>
    
</div>
</div>
</body>
</html>
