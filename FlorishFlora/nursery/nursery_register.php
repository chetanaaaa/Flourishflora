<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nursery Registration</title>

 <!--bootsrap css-->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../style.css">
 <style>
     body
        {   overflow:hidden;
             margin: 0;
  padding: 0;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
            background-image:url('../images/admin_login.jpg');
            opacity:75%
        }
        </style>
</head>
<body>
    <div class="container-fluid m-3">
  <h2 class="text-center mb-5">Nursery Registration</h2>
  <h3 class="text-center">FLOURISH FLORA</h3>
    <p class="text-center">Your Nursery's green companian</p>
<div class="row d-flex justify-content-center">
    <div class="col-lg-6 col-xl-5">

</div>
<div class="col-lg-6">
        <form action="" method="post">
            <div class="outline mb-4">
                <label for="name" class="form-label text-light">Nursery Name</label><br>
                <input type="text" id="name" name="name" placeholder="Enter Your Name" required="required" class="form-control">
                <div class="outline mb-4 ">
                <label for="email" class="form-label">Email</label><br>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" required="required" class="form-control">
                <div class="outline mb-4">
                <label for="password" class="form-label">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Enter Your Password" required="required" class="form-control">
                <label for="location" class="form-label">Location</label><br>
                <input type="text" id="location" name="location" placeholder="Enter nursery location" required="required" class="form-control"></div>
<div>
    <input type="submit" class="btn bg-success py-2 px-3 border-0" name="register" Value="Register">
    <p class="small fw-bold mt-2 pt-1 ">Already have an account?<a href="nursery_login.php" class="link-danger">Login</a></p>
            </form>
    </form>

    </div>
    
</body>
<?php

include('../includes/connect.php');

if(isset($_POST['register'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $location=$_POST['location'];

    // select query

    $select_query="select * from nursery where email='$email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('email already exixts😕')</script>";
    }
    else{
    // insert query
    $insert_query="insert into nursery
    (name,email,password,location) values 
    ('$name','$email','$hash_password','$location')";
    $sql_execute=mysqli_query($con,$insert_query);
    if($sql_execute)
    {
        echo"<script>alert('Successfully Registered!')</script>";
        echo"<script>window.open('nursery_login.php','_self')</script>";
    }
    }
    
    }
   ?>

</html>
