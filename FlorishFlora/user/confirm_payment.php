<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $selectq="select * from orders where order_id=$order_id";
    $runq=mysqli_query($con,$selectq);
    $row_fetch=mysqli_fetch_assoc($runq);
    $invoice_number=$row_fetch['invoice_number'];
    $amount=$row_fetch['amount_due'];

}

if(isset($_GET['confirm_payment'])){
    $invoice_number=$_GET['invoice_number'];
    $payment_mode=$_GET['payment_mode'];
    $insertq="insert into payments (order_id,payment_mode,date_of_payment) values($order_id,'$payment_mode',NOW())";
    $res=mysqli_query($con,$insertq);
    if($res){
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $updateq="update orders set status='complete' where order_id=$order_id";
    $res=mysqli_query($con,$updateq);
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
    <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" class="post">
        <div class="form-outline my-4 text-center w-50 m-auto">
            <input type="number" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
        </div>
        <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="" class="text-light">Amount</label>
            <input type="number" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount ?>">
        </div>
        <div class="form-outline my-4 text-center w-50 m-auto">
            <select name="payment_mode" class="form-select w-50 m-auto">
                <option>Select Payment mode</option>
                <option>UPI</option>
                <option>NetBanking</option>
                <option>PayPal</option>
                <option>Cash On Delivery</option>
                <option>Pay Offline</option>
            </select>
        </div>
        <div class="form-outline my-4 text-center">
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            <input type="submit" class="bg-success py-2 px-3 border-0" value="Confirm" name="confirm_payment">
        </div>
        </form>
    </div>
    
</body>
</html>