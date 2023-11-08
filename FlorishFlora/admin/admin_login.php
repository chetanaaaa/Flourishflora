<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

 <!--bootsrap css-->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="stylesheet" href="../style.css">
 <style>
     body
        {    margin: 0;
  padding: 0;
  overflow:hidden;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
            background-image:url('../images/admin_login.jpg') ;
            opacity:75%;
        }    
        </style>
</head>
<body>
    <div class="container-fluid m-3">
  <h3 class="text-center mb-5 text-dark">Admin Login</h2>
  <h4 class="text-center text-darks">FLOURISH FLORA</h3>
    <p class="text-center text-dark">Your Nursery's green companian</p>
<div class="row d-flex justify-content-center">
    <div class="col-lg-6 col-xl-5">
</div>
<div class="col-lg-6">
        <form action="" method="post">
            <div class="outline mb-4">
                <label for="name" class="form-label">User Name</label><br>
                <input type="text" id="name" name="name" placeholder="Enter Your Name" required="required" class="form-control" autocomplete="off">
                <div class="outline mb-4">
                <label for="password" class="form-label">Password</label><br>
                <input type="password" id="password" name="password" placeholder="Enter Your Password" required="required" class="form-control">
    </div>
<div>
    <input type="submit" class="btn bg-success py-2 px-3 border-0" name="login" Value="Login">

            </form>
    </form>

    </div>
    
</body>
</html>
<?php
if(isset($_POST['login']))
{
    $name=$_POST['name'];
    $password=$_POST['password'];
    $select_query="select * from admin where name='$name'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    
    if($row_data=mysqli_fetch_assoc($result)){
    $admin_id=$row_data['admin_id'];
    $name=$row_data['name'];
    }
    if($row_count>0){
        $_SESSION['name']=$name;
        if(password_verify($password,$row_data['password'])){
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['name']=$name;
                echo "<script>alert('Logged in successfully!🤩')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
            else{
                $_SESSION['name']=$name;
                echo "<script>alert('Logged in successfully!🥳')</script>";
                echo "<script>window.open('index.php','_self')</script>";
            }
        }else{
            echo "<script>alert('Invalid Credentials😥')</script>";
        }}
    else{
        echo "<script>alert('Invalid Credentials😥')</script>";
    }
}

?>