<?php
if(isset($_GET['delete_category']))
{
    $delete_category=$_GET['delete_category'];
    $query="Delete from categories where category_id=$delete_category";
    $result=mysqli_query($con,$query);
    if($result)
    {
        echo"<script>alert('Category removed Succesffuly')</script>";
        echo"<script>window.open('index.php?view_categories','_self')</script>";
    }
}
    ?>