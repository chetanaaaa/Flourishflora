<?php 
if(isset($_GET['remove_plants']))
{
    $delete_id=$_GET['remove_plants'];
    $delete_plants="Delete from plants where plant_id=$delete_id";
    $result=mysqli_query($con,$delete_plants);
    if($result)
    {
        echo "<script>alert('Successfully Deleted')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }

}
?>