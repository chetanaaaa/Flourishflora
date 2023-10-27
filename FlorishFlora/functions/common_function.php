<?php
include("./includes/connect.php");

//getting plants
function getplants(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])) {
    $select_query="select * from plants";
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
    <a href='#' class='btn btn-danger'>Add to cart</a>
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
    <div class='card'>
    <img src='./nursery/img/$image'class='card-img-top' alt='$plant_name'>
  <div class='card-body'>
  <h4 class='card-title'>$plant_name</h5>
  <h6 class='card-title'>$nursery_name</h5>
  <h6>Description</h6><p class='card-text'>$plant_desc</p>
  <h6 class='card-text'>Price-$price</h6>
  <a href='#' class='btn btn-danger'>Add to cart</a>
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
  <a href='#' class='btn btn-danger'>Add to cart</a>
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
  <a href='#' class='btn btn-danger'>Add to cart</a>
</div>
</div>
  </div>";
}
}
}

?>