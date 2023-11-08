<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
if(isset($_SESSION['email'])){
$user_ip=$_SERVER['REMOTE_ADDR'];
$email=$_SESSION['email'];
$get_user="select * from user_table where email='$email'";
$result=mysqli_query($con,$get_user);
$runq=mysqli_fetch_assoc($result);
$cust_id=$runq['cust_id'];
$fname=$runq['fname'];
$lname=$runq['lname'];
$address=$runq['address'];
$contact=$runq['contact'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="bg-secondary">
    <div class="container my-5">
    <div class="text-center text-dark">
        <h1>Customer Information</h1>
        <p><strong>Name:</strong> <?php echo "$fname $lname" ?></p>
        <p><strong>Email:</strong> <?php echo $email ?></p>
        <p><strong>Phone:</strong> <?php echo $contact ?></p>
    </div>
    
<?php
$correlated="SELECT
quantity,
(select plant_name from plants as p
where p.plant_id = cd.plant_id
) as plant_name,
(select cd.quantity * p.price from plants as p
where p.plant_id = cd.plant_id
) as price
from cart_details as cd";
$grand_total=0;

echo "<table class='table table-bordered mt-5 bg-secondary'>
<tr>
    <th>Plant</th>
    <th>Quantity</th>
    <th>Price</th>
</tr>";
$res=mysqli_query($con,$correlated);
if($res){
    while($row=mysqli_fetch_assoc($res)){
        $plant_name=$row['plant_name'];
        $quantity=$row['quantity'];
        $price=$row['price'];
        echo "<tr>
            <td>$plant_name</td>
            <td>$quantity</td>
            <td>$price</td>
        </tr>";
        $grand_total+=$price;
    }
}
echo "</table>";
$amount=number_format($grand_total);
echo "<h5 class='text-center'>Rs. $amount/-</h5>";
?>

        <div class="my-4 text-center w-50 m-auto">
            <select name="payment_mode" class="form-select w-50 m-auto">
                <option>Cash On Delivery</option>
                <option>UPI</option>
                <option>NetBanking</option>
                <option>PayPal</option>
                <option>Pay Offline</option>
            </select>
        </div>
        <div class="form-outline my-4 text-center">
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            <button class='bg-success py-2 px-3 border-0'>
            <?php echo "<a class='text-light' href='order.php?cust_id=$cust_id' target='_blank'>Confirm Payment     </a>"; ?>
            </button>
        </div>
    </div>

    
</body>
</html>