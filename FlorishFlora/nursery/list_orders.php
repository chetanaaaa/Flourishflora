<h3 class="text-center text-success">All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">

        <?php 
        $nursery=$_SESSION['name'];
        $get_orders="CALL ListOrdersByNursery('$nursery')";
        $result=mysqli_query($con,$get_orders);
        $row_count=mysqli_num_rows($result);
        echo"<tr>
    
    <td>customer Fname</td>
    <td>customer lname</td>
    <td>amounnt</td>
    <td>InvoiceDnumber</td>
    <td>date</td>
    <td>Status</td>
        }
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
        $cust_name=$row_data['customer_firstname'];
        $cust_lname=$row_data['customer_lastname'];
        $amt=$row_data['total_amount'];
        $invoice=$row_data['invoice_number'];
        $status=$row_data['status'];
        $date=$row_data['date'];
        
    
echo"<tbody class='bg-success text-light'>
<tr>
 
    <td>$cust_name</td>
    <td>$cust_lname</td>
    <td>$amt</td>
    <td>$invoice</td>
    <td>$date</td>
    <td>$status</td>
    ";
    
    
}
}
?>
</tbody>
    

</table>