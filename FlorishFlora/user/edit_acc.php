<?php
if(isset($_GET['edit_account'])){
    $email=$_SESSION['email'];
    $selectq="select * from user_table where email='$email'";
    $runq=mysqli_query($con,$selectq);
    $row=mysqli_fetch_assoc($runq);
    $cust_id=$row['cust_id'];
    $fname=$row['fname'];
    $lname=$row['lname'];
    $email=$row['email'];
    $address=$row['address'];
    $contact=$row['contact'];

    if(isset($_POST['update'])){
        $update_id=$cust_id;
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $contact=$_POST['contact'];

        $updateq="update user_table set 
        fname='$fname',lname='$lname',email='$email',address='$address',contact='$contact' 
        where cust_id=$update_id";
        $runu=mysqli_query($con,$updateq);
        if($runu){
            echo "<script>alert('Data updated successfully')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
</head>
<body>
    <h3 class="text-success mb-4">Edit your Account</h3> 
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $fname ?>" class="form-control w-50 m-auto" name="fname">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $lname ?>" class="form-control w-50 m-auto" name="lname">
        </div>
        <div class="form-outline mb-4">
            <input type="email" value="<?php echo $email ?>" class="form-control w-50 m-auto" name="email">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $address ?>" class="form-control w-50 m-auto" name="address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $contact ?>" class="form-control w-50 m-auto" name="contact">
        </div>

        <input type="submit" value="Update" class="bg-success py-2 px-3 b-0" name="update">
    </form>   
</body>
</html>