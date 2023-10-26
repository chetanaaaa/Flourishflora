<?php
include('../includes/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 <!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../style.css">
<body  style="background-color:rgb(163, 233, 163)!important">
    <div class="container mt-3">
        <h1 class="text-ceneter">Insert Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_name" class="form-label ">Plant Name</label>
            <input type="text" name="plant_name" id="plant_name" class="form-control bg-light text-dark" placeholder="Enter Name of the Plant" autocomplete="off" required="required">

        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_desc" class="form-label ">Plant Description</label>
            <input type="text" name="plant_desc" id="plant_desc" class="form-control bg-light text-dark" placeholder="Enter Plant Description" autocomplete="off" required="required">

        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <select name="categories" id="" class="form-select bg-light">
                <option value="" class="bg-dark">Select a Category</option>
                <?php 
                $select_query="select * from categories";
                $result_query=mysqli_query($con,$select_query);
                while($row=mysqli_fetch_assoc($result_query))
                {
                    $category_title=$row['category_title'];
                    $category_id=$row['category_id'];
                    echo"<option value='$category_id' class='bg-dark text-dark'>$category_title</option>";

                }
?>
</select>
</div>
<div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_img1" class="form-label ">Plant Image</label>
            <input type="file" name="plant_img" id="plant_img" class="form-control bg-light text-dark" placeholder="Insert Image" autocomplete="off" required="required">

        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="stock" class="form-label ">Stocks</label>
            <input type="text" name="stock" id="stock" class="form-control bg-light text-dark" placeholder="Enter the Number of stocks" autocomplete="off" required="required">

        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_price" class="form-label ">Plant Price</label>
            <input type="text" name="plant_price" id="plant_price" class="form-control bg-light text-dark" placeholder="Enter the Amount per plant" autocomplete="off" required="required">

        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="insert_palnt" class="btn bg-success text-light mb-3 px-3" value="Insert Plant">
        </div>
    </div>
</form> 
</body>
</html>