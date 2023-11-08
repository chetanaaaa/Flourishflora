<?php 
$query="SELECT plant_name 
FROM plants p
WHERE NOT EXISTS (
  SELECT 1
  FROM order_plants od
  WHERE od.plant_id = p.plant_id
);"
$result=mysqli_query($con,$query);
while($row_data=mysqli_fetch_assoc($result))
{
$plant_name=$row_data['plant_name'];
};
?>
<h3 