<h3 class="text-center text-success">All Nurseries</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php 
        $get_users="select * from nursery";
        $total_users="select count(*) as nursery from nursery";
        $users=mysqli_query($con,$total_users);
        $row=mysqli_fetch_assoc($users);
        $total=$row['nursery'];
        $result=mysqli_query($con,$get_users);
        $row_count=mysqli_num_rows($result);
        echo"<tr>
        <th>Nursery Id</th>
        <th>Nursery Name</th>
        <th>Location</th>
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
        $nursery_id=$row_data['nursery_id'];
        $name=$row_data['name'];
        $location=$row_data['location'];
       
echo"<tbody class='bg-success text-light'>
<tr>

    <td>$nursery_id</td>
    <td>$name</td>
    <td>$location</td>
    ";?>
    
    <td><a href='index.php?remove_nurseries=<?php echo $nursery_id?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td>
    
    
    <?php
}
}
?>
<h3 class="text-center text-danger">Total Nurseries:<?php echo $total;?></h3>
</tbody>
    

</table>