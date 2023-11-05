<?php 
include('../includes/connect.php');
include('../functions/common_function.php');

if([isset($_GET['cust_id'])]){
    $cust_id=$_GET['cust_id'];
global $con;
$total_price=0;
$invoice_num=mt_rand();
$status='pending';
$ip_addr=$_SERVER['REMOTE_ADDR'];

$insert_orders="insert into orders (cust_id,invoice_number,date,status) values ($cust_id,$invoice_num,NOW(),'$status')";
$resultq=mysqli_query($con,$insert_orders);
$order_id=mysqli_insert_id($con);

$cartq="select * from cart_details where ip_address='$ip_addr'";
$result_rows=mysqli_query($con,$cartq);
$count=0;

while($row=mysqli_fetch_array($result_rows)){
    $plant_id=$row['plant_id'];
    $quantity=$row['quantity'];
    $select_plant="select * from plants where plant_id=$plant_id";
    $run=mysqli_query($con,$select_plant);
    $plant_data=mysqli_fetch_assoc($run);
    $price=$plant_data['price'];
    $total_price+=$price*$quantity;
    $count+=$quantity;

    $insert_query="insert into order_plants (order_id,plant_id,quantity) values ($order_id,$plant_id,$quantity)";
    $run=mysqli_query($con,$insert_query);
}

$update_query="update orders set amount_due=$total_price where order_id=$order_id";
$resq=mysqli_query($con,$update_query);
if($resq){    
    echo "<script>alert('Orders submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}
//deleting items from cart
 $empty_cart="delete from cart_details";
 $res=mysqli_query($con,$empty_cart);

}

?>
