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
$get_plants="Select * from `plants`";
$results=mysqli_query($con,$get_plants);
while($row=mysqli_fetch_assoc($results)){
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
    <td><?php>"echo $plant_id</td>
    <td>$plant_name</td>
    <td><img src='../nursery/img/$plant_image' class='product_img'</td>
    <td>$desc</td>
    <td>$nursery</td>
    <td>$price</td>
    <td>$stocks</td>";?>
    <td><?php 
    $get_count=select * from orders where plant </td>
    <td>$status</td>
    <td><a href='' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
    <td><a href='' class='text-dark'><i class='fa-solid fa-trash'></i></a></td></tr>";

<?php

}
?>


    <tr class="text-center">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><a href="" class="text-dark"><i class="fa-solid fa-pen-to-square"></i></a></td>
        <td><a href="" class="text-dark"><i class="fa-solid fa-trash"></i></a></td>

</tr>
</tbody>
</table>

