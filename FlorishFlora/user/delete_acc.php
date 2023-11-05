<h3 class="text-danger mb-4">Delete Account</h3>
<form action="" method="post" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="nodelete" value="Don't Delete Account">
    </div>
</form>

<?php
$email=$_SESSION['email'];
if(isset($_POST['delete'])){
    $deleteq="delete from user_table where email='$email'";
    $run=mysqli_query($con,$deleteq);
    if($run){
        session_destroy();
        echo "<script>alert('Account deleted successfully')</script>";
        echo "<script>window.open('../index.php',''_self'')</script>";
    }
}
if(isset($_POST['nodelete'])){
    echo "<script>window.open('../index.php','_self')</script>";
}
?>