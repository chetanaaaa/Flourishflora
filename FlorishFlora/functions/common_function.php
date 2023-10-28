<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FlorishFlora</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  
</body>
</html>
<?php
include("./includes/connect.php");


//getting plants
function getplants(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])) {
    $select_query="select * from plants order by rand() LIMIT 0,9";
    $result_query=mysqli_query($con,$select_query);
    while($row=mysqli_fetch_assoc($result_query))
    { 
      $plant_id=$row['plant_id'];
      $plant_name=$row['plant_name'];
      $plant_desc=$row['plant_desc'];
      $category_id=$row['category_id'];
      $image=$row['image'];
      $price=$row['price'];
      $stocks=$row['stocks'];
      $nursery_name=$row['n_name'];
      echo "<div class='col-md-4 md-2'>
      <div class='card' style='width: 100%; height: 100%;'>
      <img src='./nursery/img/$image'class='card-img-top' alt='$plant_name'>
    <div class='card-body'>
    <h4 class='card-title'>$plant_name</h5>
    <h6 class='card-title'>$nursery_name</h5>
    <h6>Description</h6><p class='card-text'>$plant_desc</p>
    <h6 class='card-text'>Price-$price</h6>
    <form method='get'>
    <input type='hidden' name='plant_id' value=$plant_id>
    <input type='submit' class='btn btn-danger' value='Add to Cart'>
</form>
</div>
</div>
    </div>";
  }
}
}

function get_all_plants(){
  global $con;

  //condition to check isset or not
  if(!isset($_GET['category'])) {
  $select_query="select * from plants order by plant_name";
  $result_query=mysqli_query($con,$select_query);
  while($row=mysqli_fetch_assoc($result_query))
  { 
    $plant_id=$row['plant_id'];
    $plant_name=$row['plant_name'];
    $plant_desc=$row['plant_desc'];
    $category_id=$row['category_id'];
    $image=$row['image'];
    $price=$row['price'];
    $stocks=$row['stocks'];
    $nursery_name=$row['n_name'];
    echo "<div class='col-md-4 md-2'>
    <div class='card'>
    <img src='./nursery/img/$image'class='card-img-top' alt='$plant_name'>
  <div class='card-body'>
  <h4 class='card-title'>$plant_name</h5>
  <h6 class='card-title'>$nursery_name</h5>
  <h6>Description</h6><p class='card-text'>$plant_desc</p>
  <h6 class='card-text'>Price-$price</h6>
  <form method='get'>
    <input type='hidden' name='plant_id' value=$plant_id>
    <input type='submit' class='btn btn-danger' value='Add to Cart'>
</form>
</div>
</div>
  </div>";
}
}
}

//getting unique categories
function get_unique_categories(){
  global $con;

  //condition to check isset or not
  if(isset($_GET['category'])) {
    $category_id=$_GET['category'];
  $select_query="select * from plants where category_id=$category_id";
  $result_query=mysqli_query($con,$select_query);
  $num_of_rows=mysqli_num_rows($result_query);
  if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>No stock in this category :/</h2>";
  }
  while($row=mysqli_fetch_assoc($result_query))
  { 
    $plant_id=$row['plant_id'];
    $plant_name=$row['plant_name'];
    $plant_desc=$row['plant_desc'];
    $category_id=$row['category_id'];
    $image=$row['image'];
    $price=$row['price'];
    $stocks=$row['stocks'];
    $nursery_name=$row['n_name'];
    echo "<div class='col-md-4 md-2'>
    <div class='card'>
    <img src='./nursery/img/$image'class='card-img-top' alt='$plant_name'>
  <div class='card-body'>
  <h4 class='card-title'>$plant_name</h5>
  <h6 class='card-title'>$nursery_name</h5>
  <h6>Description</h6><p class='card-text'>$plant_desc</p>
  <h6 class='card-text'>Price-$price</h6>
  <form method='get'>
    <input type='hidden' name='plant_id' value=$plant_id>
    <input type='submit' class='btn btn-danger' value='Add to Cart'>
</form>
</div>
</div>
  </div>";
}
}
}



//displaying categories in side nav
function getcategories(){
  global $con;
  $select_category="select * from categories";
  $result_category=mysqli_query($con,$select_category);
  while($row_data=mysqli_fetch_assoc($result_category))
  {
    $category_title=$row_data['category_title'];
    $category_id=$row_data['category_id'];
    echo"<li class='nav-item'>
    <a href='index.php?category=$category_id' class='nav-link text-light m-3 '>$category_title</a>
    </li>";
          }
}


//searching plants function
function search_plant(){
  global $con;
  if(isset($_GET['search_data_plant'])){
    $search_data_value=$_GET['search_data'];
  $search_query="select * from plants where plant_name like '%$search_data_value%'";
  $result_query=mysqli_query($con,$search_query);
  $num_of_rows=mysqli_num_rows($result_query);
  if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>Stock not available :(</h2>";
  }
  while($row=mysqli_fetch_assoc($result_query))
  { 
    $plant_id=$row['plant_id'];
    $plant_name=$row['plant_name'];
    $plant_desc=$row['plant_desc'];
    $category_id=$row['category_id'];
    $image=$row['image'];
    $price=$row['price'];
    $stocks=$row['stocks'];
    $nursery_name=$row['n_name'];
    echo "<div class='col-md-4 md-2'>
    <div class='card'>
    <img src='./nursery/img/$image'class='card-img-top' alt='$plant_name'>
  <div class='card-body'>
  <h4 class='card-title'>$plant_name</h5>
  <h6 class='card-title'>$nursery_name</h5>
  <h6>Description</h6><p class='card-text'>$plant_desc</p>
  <h6 class='card-text'>Price-$price</h6>
  <form method='get'>
    <input type='hidden' name='plant_id' value=$plant_id>
    <input type='submit' class='btn btn-danger' value='Add to Cart'>
</form>
</div>
</div>
  </div>";
}
}
}


//cartfunction
function cart(){
  global $con;
if(isset($_GET['plant_id'])){
  $get_plant_id=$_GET['plant_id'];
  $get_ip_address=$_SERVER['REMOTE_ADDR'];
    $select_query="select * from cart_details where ip_address='$get_ip_address' and plant_id=$get_plant_id";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0){
      echo "<script>alert('this item is already in cart')</script>";
      echo"<script>window.open('index.php','_self')</script>";

  }
  else{
    $insert_query="insert into cart_details (plant_id,ip_address) values($get_plant_id,'$get_ip_address')";
    $result_query=mysqli_query($con,$insert_query);
    echo "<script>alert('item successfully inserted')</script>";
    echo"<script>window.open('index.php','_self')</script>";
  }
}
}

//function for get cart item number
function cart_item(){
  $num_rows=0;
  global $con;
  // if(isset($_GET['plant_id'])){
    $get_ip_address=$_SERVER['REMOTE_ADDR'];
    $select_query="select * from cart_details where ip_address='$get_ip_address'";
    $result_query=mysqli_query($con,$select_query);
    $num_rows = mysqli_num_rows($result_query);
    echo $num_rows;
   
  }



//total price function
function total_cart_price(){
  global $con;
  $get_ip_address=$_SERVER['REMOTE_ADDR'];
  $total=0;

  $cart_query="select * from cart_details where ip_address='$get_ip_address'";
  $result=mysqli_query($con,$cart_query);
  while($row=mysqli_fetch_array($result)){
    $plant_id=$row['plant_id'];
    $select_plants="select * from plants where plant_id=$plant_id";
    $result_plant=mysqli_query($con,$select_plants);
    while($row_plant_price=mysqli_fetch_array($result_plant)){
      $plant_price=array($row_plant_price['price']);
      $plant_values=array_sum($plant_price);
      $total+=$plant_values;
    }
  }
  echo "$total";

}


?>