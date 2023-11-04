<?php
if (isset($_GET['edit_plants'])) {
    $edit_id = $_GET['edit_plants'];
    $get_data = "SELECT * FROM plants WHERE plant_id = $edit_id";
    $result = mysqli_query($con, $get_data);
    $row = mysqli_fetch_assoc($result);
    $plant_name = $row['plant_name'];
    $plant_image = $row['image'];
    $category_id = $row['category_id'];
    $price = $row['price'];
    $stocks = $row['stocks'];
    $nursery = $row['n_name'];
    $desc = $row['plant_desc'];
    $select_cat = "SELECT * FROM categories WHERE category_id = $category_id";
    $result_query = mysqli_query($con, $select_cat);
    $row = mysqli_fetch_assoc($result_query);
    $category_title = $row['category_title'];


if (isset($_POST['edit_plant'])) {
    $plant_title = $_POST['plant_name'];
    $plant_desc = $_POST['plant_desc'];
    $nursery_name = $_POST['nursery_name'];
    $plant_category = $_POST['categories'];
    $plant_price = $_POST['plant_price'];
    $plant_stocks = $_POST['stock'];
    $plant_status = 'true';

    if (!empty($_FILES['plant_img']['name'])) {
        // New image was uploaded
    $plant_img=$_FILES['plant_img']['name'];
    $image_size=$_FILES["plant_img"]["size"];
    $temp_img=$_FILES["plant_img"]["tmp_name"];
    $validimageextension=["jpg","jpeg","png"];
    $imageextension=explode('.',$plant_img);
    $imageextension=strtolower(end($imageextension));

        if (!in_array($imageextension, $validimageextension) || $image_size > 1000000) 
        {
            echo "<script>alert('Invalid image or image size exceeded. Image not updated.')</script>";
        } 
        
        else {
            $newImageName=uniqid();
           $newImageName= $plant_img ;

        move_uploaded_file($temp_img,"../nursery/img/$newImageName");
            
        }
       }
    else {
        // No new image was uploaded, keep the existing image
        $plant_img = $plant_image;
    }
    
    
    $update_plant = "UPDATE plants SET plant_name='$plant_title',
    plant_desc='$plant_desc',category_id=$category_id,image='$plant_img', price=$plant_price, stocks=$plant_stocks, n_name='$nursery_name', date=NOW(), status='$plant_status' WHERE plant_id = $edit_id";
    $result_query = mysqli_query($con, $update_plant);
    if ($result_query) {
        echo "<script>alert('Successfully Updated')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }
    else
    {
        echo"Error:".mysqli_error($con);
    }
}
}
?>

<style>
.products_img {
    width: 100%;
    height: 10vw;
    object-fit: contain;
}
</style>

<div class="container m-5">
    <h1 class="text-center">Edit Plant details</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_name" class="form-label">Plant Name</label>
            <input type="text" name="plant_name" id="plant_name" value="<?php echo $plant_name ?>" class="form-control bg-light text-dark" placeholder="Enter Name of the Plant" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_desc" class="form-label">Plant Description</label>
            <input type="text" name="plant_desc" id="plant_desc" value="<?php echo $desc ?>" class="form-control bg-light text-dark" placeholder="Enter Plant Description" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="nursery_name" class="form-label">Nursery Name</label>
            <input type="text" name="nursery_name" id="nursery_name" value="<?php echo $nursery; ?>" class="form-control bg-light text-dark" placeholder="Enter Nursery name" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="categories" class="form-label">Categories</label>
            <select name="categories" class="form-select">
                <option value="<?php echo $category_id?>"><?php echo $category_title ?></option>
                <?php 
                $select_query_all = "SELECT * FROM categories";
                $result_query_all = mysqli_query($con, $select_query_all);
                while ($row_new = mysqli_fetch_assoc($result_query_all)) {
                    $category_titles = $row_new['category_title'];
                    $category_ids = $row['category_id'];
                    echo "<option value='$category_ids'>$category_titles</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_img1" class="form-label">Plant Image</label>
            <div class="d-flex">
                <input type="file" name="plant_img" id="plant_img" class="form-control bg-light text-dark w-90 m-auto" autocomplete="off">
                <img src="../nursery/img/<?php echo $plant_image ?>" alt="" class="products_img">
            </div>
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="stock" class="form-label">Stocks</label>
            <input type="text" name="stock" id="stock" value="<?php echo $stocks ?>" class="form-control bg-light text-dark" placeholder="Enter the Number of stocks" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="plant_price" class="form-label">Plant Price</label>
            <input type="text" name="plant_price" id="plant_price" value="<?php echo $price ?>" class="form-control bg-light text-dark" placeholder="Enter the Amount per plant" autocomplete="off" required="required">
        </div>
        <div class="form-outline mb-4 w-50 m-auto">
            <input type="submit" name="edit_plant" class="btn bg-success text-light mb-3 px-3" value="Update Plant">
        </div>
    </form>
</div>
