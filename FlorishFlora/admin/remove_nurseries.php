<?php 
if(isset($_GET['remove_nurseries']))
{
  $nursery_id=$_GET['remove_nurseries'];
  $query="Delete from nursery where nursery_id=$nursery_id";
  $result=mysqli_query($con,$query);
  if($result)
  {
    echo"<script>alert('Nursery deleted')</script>";
    echo"<script>window.open('index.php?list_nurseries','_self')</script>";
   
  }
}
?>