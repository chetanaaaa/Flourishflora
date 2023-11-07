
<style>
.name {
    font-weight: bold;
    color: blue; /* Change the color to your preference */
}

.sales {
    font-weight: bold;
    color: red; /* Change the color to your preference */
    font-size: 24px; /* Adjust the font size as needed */
}
</style>
<?php 
if(isset($_GET['sales']))
{   
    $name=$_SESSION['name'];
    $query="Select totalsales('$name') as total";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $sales=$row['total'];
    echo "<h2 class='text-center mb-5 sales'>
    Total Revenue of $name:
</h2>
<h1 class='text-center mb-5 name'>Rs.$sales/-</h1>";
}

?>