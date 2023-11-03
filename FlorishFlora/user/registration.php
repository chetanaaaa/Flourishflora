<?php 
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!--bootsrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color:rgb(163, 233, 163)!important">
<div class="container-fluid my-3">
    <h2 class="text-center">New User Registration</h2>
    <div class="row d-flex align-items-centre justify-content-center">
        <div class="col-lg-12 col-xl-6">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <label for="fname" class="form-label">First Name</label>
        <input type="text" id="fname" class="form-control" placeholder="Enter your First name" autocomplete="off" required="required" 
        name="fname"/>
    </div>
    <div class="form-outline mb-4">
        <label for="lname" class="form-label">Last Name</label>
        <input type="text" id="lname" class="form-control" placeholder="Enter your Last name" autocomplete="off" required="required" 
        name="lname"/>
    </div>
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
    <div class="form-outline mb-4">
        <label for="address" class="form-label">address</label>
        <input type="text" id="address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" 
        name="address"/>
    </div>
    <div class="form-outline mb-4">
        <label for="contact" class="form-label">Contact</label>
        <input type="text" id="contact" class="form-control" placeholder="Enter your mobile number" autocomplete="off" required="required" 
        name="contact"/>
    </div>
    <div class="mt-4 pt-2">
        <input type="submit" value="Register" class="bg-success py-2 px-3 border=0" name="register"/>
        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php">Login</a></p>
    </div>
</form>
        </div>
    </div>
</div>   
    
</body>
</html>


<!--php code-->
<?php
if(isset($_POST['register'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hash_password=password_hash($password,PASSWORD_DEFAULT);
    $address=$_POST['address'];
    $contact=$_POST['contact'];
    $user_ip=$_SERVER['REMOTE_ADDR'];

    // select query

    $select_query="select * from `user_table` where email='$email'";
    $result=mysqli_query($con,$select_query);
    $rows_count=mysqli_num_rows($result);
    if($rows_count>0){
        echo "<script>alert('email already exixts😕')</script>";
    }
    else{
    // insert query
    $insert_query="insert into `user_table` 
    (fname,lname,email,password,user_ip,address,contact) values 
    ('$fname','$lname','$email','$hash_password','$user_ip','$address','$contact')";
   

    $sql_execute=mysqli_query($con,$insert_query);
    }
    
    $select_cart_items="select * from cart_details where
    ip_address='$user_ip'";
    $result_cart=mysqli_query($con,$select_cart_items);
    $rows_count=mysqli_num_rows($result_cart);
    if($rows_count>0){
        $_SESSION['email']=$email;
        echo "<scriptalert('You have items in your cart🤗')></script>";
        echo "<script>window.open('checkout.php','_self'</script>";
    }
    else{
        echo "<script>window.open('./index.php','_self')</script>";
    }
    
}
?>