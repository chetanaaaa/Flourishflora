<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
<thread class="bg-success">
    <tr class="text-center">
        <td>Category Id</td>
        <td>Category Title</td>
        <td>Edit</td>
        <td>Delete</td>
</tr>
</thread>
<tbody class="bg-dark text-center text-light">
    <?php 
    $select_cat="Select * from categories";
   $result=mysqli_query($con,$select_cat);
   while($row=mysqli_fetch_assoc($result)) 
   {
    $category_id=$row['category_id'];
    $category_title=$row['category_title'];
   ?>
    <tr>
      <td><?php echo"$category_id</td>
        <td>$category_title</td>";
    ?>
    <td><a href='index.php?edit_category=<?php echo $category_id?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
    <td><a href='index.php?delete_category=<?php echo$category_id?>'><i class='fa-solid fa-trash'></i></a></td>
</tr>
<?php
}?>
</tbody>
</table>