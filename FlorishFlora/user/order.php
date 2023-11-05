<?php 
include('../includes/connect.php');
include('../functions/common_function.php');

if([isset($_GET['cust_id'])]){
    $cust_id=$_GET['cust_id'];
global $con;
$total_price=0;
$invoice_num=mt_rand();
$status='pending';
$cartq="select * from cart_details";
$result_rows=mysqli_query($con,$cartq);
$count=mysqli_num_rows($result_rows);
while($row=mysqli_fetch_assoc($result_rows)){
    $plant_id=$row['plant_id'];
    $quantity=$row['quantity'];
    $select_plant="select * from plants where plant_id=$plant_id";
    $run=mysqli_query($con,$select_plant);
    $plant_data=mysqli_fetch_assoc($run);
    $price=$plant_data['price'];
    $total_price+=$price*$quantity;
    $count+=$quantity;
}

$insert_orders="insert into orders (cust_id,plant_id,amount_due,invoice_number,total_products,date,status) values($cust_id,$plant_id,$total_price,$invoice_num,$count,NOW(),'$status')";
$resultq=mysqli_query($con,$insert_orders);
if($resultq){    
    echo "<script>alert('Orders submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}
//deleting items from cart
 $empty_cart="delete from cart_details";
 $res=mysqli_query($con,$empty_cart);

}

?>
