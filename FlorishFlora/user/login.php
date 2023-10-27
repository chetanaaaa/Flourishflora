<?php 
include('../includes/connect.php');
// include('../functions/common_function.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!--bootsrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
   body{
        overflow-x:hidden;
    }
</style>

<body style="background-color:rgb(163, 233, 163)!important">
<div class="container-fluid my-3">
    <h2 class="text-center">User Login</h2>
    <div class="row d-flex align-items-centre justify-content-center">
        <div class="col-lg-12 col-xl-6">
<form action="" method="post">
    <div class="form-outline mb-4">
        <label for="email" class="form-label">email</label>
        <input type="email" id="email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" 
        name="email"/>
    </div>
    <div class="form-outline mb-4">
        <label for="password" class="form-label">password</label>
        <input type="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" 
        name="password"/>
    </div>
    <div class="mt-4 pt-2">
        <input type="submit" value="Login" class="bg-success py-2 px-3 border=0" name="login"/>
        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="registration.php">Register</a></p>
    </div>
</form>
        </div>
    </div>
</div>   
    
</body>
</html>

<?php

if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $select_query="select * from `user_table` where email='$email'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    // $user_ip=getIPAddress()

// ///////////cart item
// $select_query_cart="select * from `cart_details` where ip_address='$user_ip'";
// $select_cart=mysqli_query($con,$select_query_cart);
// $row_count_cart=mysqli_num_rows($select_cart);
    $row_count_cart=0;

    if($row_count>0){
        $_SESSION['email']=$email;
        if(password_verify($password,$row_data['password'])){
            // echo "<script>alert('Logged in successfully!')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['email']=$email;
                echo "<script>alert('Logged in successfully!')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }
            else{
                $_SESSION['email']=$email;
                echo "<script>alert('Logged in successfully!')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }

    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>