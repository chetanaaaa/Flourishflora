<?php 
if(isset($_GET['remove_orders']))
{
  $order_id=$_GET['remove_orders'];
  $query="Delete from orders where order_id=$order_id";
  $result=mysqli_query($con,$query);
  if($result)
  {
    echo"<script>alert('Order deleted')</script>";
    echo"<script>window.open('index.php?list_orders','_self')</script>";
   
  }
}
?>