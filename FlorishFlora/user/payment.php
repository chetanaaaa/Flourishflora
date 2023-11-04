<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    img{
        width:60%;
        height:80%;
        margin:auto;
        display:block;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<body>
    <!-- php code to access user id -->
    <?php
    $user_ip=$_SERVER['REMOTE_ADDR'];
    $email=$_SESSION['email'];
    $get_user="select * from user_table where email='$email'";
    $result=mysqli_query($con,$get_user);
    if($runq=mysqli_fetch_assoc($result)){
    $cust_id=$runq['cust_id'];}
    
    echo "<div class='container'>
        <h2 class='text-center text-success'>Payment options</h2>
        <div class='row d-flex justify-items-center align-items-center my-'>
            <div class='col-md-6'>
            <a href='https://www.paypal.com' target='_blank'>
                <img src='../images/online.webp' alt=''></a>
            </div>
            <div class='col-md-6'>
            <a href='order.php?cust_id=$cust_id' target='_blank'><img src='../images/offline2.avif' alt=''></a>
            </div>
            
        </div>
    </div>";
    ?>

</body>
</html>