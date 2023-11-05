<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php 
        $get_users="select * from user_table";
        $total_users="select count(*) as users from user_table";
        $users=mysqli_query($con,$total_users);
        $row=mysqli_fetch_assoc($users);
        $total=$row['users'];
        $result=mysqli_query($con,$get_users);
        $row_count=mysqli_num_rows($result);
        echo"<tr>
        <th>User Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Adress</th>
        <th>Contact</th>
        <th>Delete</th>
</tr>
</thread>
<tbody class='bg-success text-light'>";
if($row_count==0)
{
    echo"<h2 class='bg-danger text-center mt-5'>No Users</h2>";

}
else
{
    while($row_data=mysqli_fetch_assoc($result))
    {
        $cust_id=$row_data['cust_id'];
        $Fname=$row_data['fname'];
        $Lname=$row_data['lname'];
        $Address=$row_data['address'];
        $contact=$row_data['contact'];
    
echo"<tbody class='bg-success text-light'>
<tr>

    <td>$cust_id</td>
    <td>$Fname</td>
    <td>$Lname</td>
    <td>$Address</td>
    <td>$contact</td>
    ";?>
    
    <td><a href='index.php?remove_users=<?php echo $cust_id?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
    
    
    <?php
}
}
?>
<h3 class="text-center text-danger">Total Users:<?php echo $total;?></h3>
</tbody>
    

</table>