<?php 
if(isset($_GET['remove_users']))
{
  $cust_id=$_GET['remove_users'];
  $query="Delete from user_table where cust_id=$cust_id";
  $result=mysqli_query($con,$query);
  if($result)
  {
    echo"<script>alert('Customer  deleted')</script>";
    echo"<script>window.open('index.php?list_users','_self')</script>";
   
  }
}
?>