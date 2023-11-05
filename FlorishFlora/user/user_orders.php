<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
$email=$_SESSION['email'];
$get_user="select * from user_table where email='$email'";
$run_q=mysqli_query($con,$get_user);
$row_fetch=mysqli_fetch_array($run_q);
$cust_id=$row_fetch['cust_id'];

?>

    <h3 class="text-center text-success">All my Orders</h3>
    <table class="table table-bordered mt-5">
    <thead class="bg-success">
        <tr>
            <th>S.no</th>
            <th>Amount Due</th>
            <th>Total products</th>
            <th>Invoice number</th>
            <th>Date</th>
            <th>Complete/Incomplete</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $num=1;
        $orderq="select * from orders where cust_id=$cust_id";
        $run_oq=mysqli_query($con,$orderq);
        while($row_orders=mysqli_fetch_assoc($run_oq)){
            $order_id=$row_orders['order_id'];
            $amount_due=$row_orders['amount_due'];
            $cust_id=$row_orders['cust_id'];
            $plant_id=$row_orders['plant_id'];
            $invoice_number=$row_orders['invoice_number'];
            $total_products=$row_orders['total_products'];
            $date=$row_orders['date'];
            $status=$row_orders['status'];
            if($status=='pending'){
                $status='Incomplete';
            }else{
                $status='Complete';
            }
              echo "<tr>
            <td>$num</td>
            <td>$amount_due</td>
            <td>$total_products</td>
            <td>$invoice_number</td>
            <td>$date</td>
            <td>$status</td>";
            ?>
            <?php
            if($status=='Complete'){
                echo "<td>Paid</td>";
            }else{
                echo "<td><a href='confirm_payment.php?order_id=$order_id'>
                Confirm</a></td>
                </tr>";
            }
        $num+=1;
        }
        ?>
    </tbody>
    </table>
</body>
</html>