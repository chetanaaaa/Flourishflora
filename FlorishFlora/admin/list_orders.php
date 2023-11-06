<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php 
        $get_orders="select * from orders";
        $result=mysqli_query($con,$get_orders);
        $row_count=mysqli_num_rows($result);
        echo"<tr>
        <th>Order Id</th>
        <th>Amount</th>
        <th>Invoice Number</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Delete</th>
</tr>
</thread>
<tbody class='bg-success text-light'>";
if($row_count==0)
{
    echo"<h2 class='bg-danger text-center mt-5'>No orders</h2>";

}
else
{
    while($row_data=mysqli_fetch_assoc($result))
    {
        $order_id=$row_data['order_id'];
        $cust_id=$row_data['cust_id'];
        $amt=$row_data['amount_due'];
        $invoice=$row_data['invoice_number'];
        $status=$row_data['status'];
        $date=$row_data['date'];
    
echo"<tbody class='bg-success text-light'>
<tr>

    <td>$order_id</td>
    <td>$amt</td>
    <td>$invoice</td>
    <td>$date</td>
    <td>$status</td>
    ";?>
    
    <td><a href='index.php?remove_orders=<?php echo $order_id ?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
    <?php
}
}
?>
</tbody>
    

</table>