
<h1 class="text-center text-success">All Plants</h1>
<table class="table table-bordered-mt-5">
<thead class="bg-success">
<tr>
    <th>ID</th> 
    <th>Plant Name</th> 
    <th>Image</th>
    <th>Description</th>
    <th>Nursery</th>
    <th>Price</th> 
    <th>Stocks</th> 
    <th>Sold</th> 
    <th>Status</th> 
    <th>Edit</th> 
    <th>Delete</th>   
</tr>
</thead>
<tbody class="bg-transparent text-dark">
<?php
$get_plants="select * from plants";
$results=mysqli_query($con,$get_plants);
while($row=mysqli_fetch_array($results)){
    $plant_id=$row['plant_id'];
    $plant_name=$row['plant_name'];
    $plant_image=$row['image'];
    $price=$row['price'];
    $stocks=$row['stocks'];
    $status=$row['status'];
    $nursery=$row['n_name'];
    $desc=$row['plant_desc'];
?>
    <tr class='text-center'>
    <td><?php echo $plant_id;?></td>
    <td><?php echo $plant_name;?></td>
    <td><img src='../nursery/img/<?php echo $plant_image;?>' class='product_img'></td>
    <td><?php echo $desc; ?></td>
    <td><?php echo $nursery;?></td>
    <td><?php echo $price;?></td>
    <td><?php echo $stocks;?></td>
    <td><?php 
    $get_count="select * from order_plants where plant_id=$plant_id ";
    $result_count=mysqli_query($con,$get_count);
    $rows_count=0;
    while($fetch_row=mysqli_fetch_array($result_count)){
        $qty=$fetch_row['quantity'];
        $rows_count+=$qty;
    }
    echo $rows_count;
    ?>
    </td>
    <td><?php 
    echo $status ?></td>
    <td><a href='index.php?edit_plants=<?php echo $plant_id ?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
    <td><a href='index.php?remove_plants=<?php echo $plant_id ?>' class='text-dark'><i class='fa-solid fa-trash'></i></a></td></tr>

<?php
}
$query = "SELECT plant_name FROM plants WHERE stocks<=5";
$run = mysqli_query($con, $query);
if ($run) {
    $arr = [];
    while ($row = mysqli_fetch_assoc($run)) {
        $arr[] = $row['plant_name'];
    }
    if (!empty($arr)) {
        $message = "Low stock for plant(s): " . implode(', ', $arr);
        echo "<h4 class='text-danger'>$message</h4>";
    }
}

?>

</tr>
</tbody>
</table>
<<<<<<< HEAD
<?php 
$query="SELECT plant_name 
FROM plants p
WHERE NOT EXISTS (
  SELECT 1
  FROM order_plants od
  WHERE od.plant_id = p.plant_id
)";
$run = mysqli_query($con, $query);
if ($run) {
    $arr = [];
    while ($row = mysqli_fetch_assoc($run)) {
        $arr[] = $row['plant_name'];
    }?>

<?php
    if (!empty($arr)) 
    {
        $message = "Plants not purchased by any Customer: " . implode(', ', $arr);
        echo "<h7 class='text-danger'>$message</h7>";
        
    }
}

?>

=======
>>>>>>> 4ebaf1ad0d75b62c65f8e504ebf5f8b2f18cf283
