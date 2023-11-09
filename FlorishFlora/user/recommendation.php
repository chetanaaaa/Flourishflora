<?php
include('../includes/connect.php');
@session_start();
$email=$_SESSION['email'];
$selectq="select * from user_table where email='$email'";
$user_res=mysqli_query($con,$selectq);
$user_row=mysqli_fetch_array($user_res);
$fname=$user_row['fname'];
$cust_id=$user_row['cust_id'];
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<link rel="stylesheet" href="../style.css">
    <title>Recommendation</title>
    <style>
        .row{

        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 class="text-center text-success">Top 3 Popular Nurseries</h2>
    <table>
        <thead>
            <tr>
                <th>Nursery Name</th>
                <th>Plants Sold</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../includes/connect.php');

            $query = "SELECT p.n_name, SUM(op.quantity) AS sold 
                      FROM order_plants op JOIN plants p ON op.plant_id = p.plant_id 
                      GROUP BY p.n_name 
                      ORDER BY sold DESC 
                      LIMIT 3";
            $res = mysqli_query($con, $query);
            while ($row = mysqli_fetch_array($res)) {
                $n_name = $row['n_name'];
                $sold = $row['sold'];
                echo "<tr>
                        <td>$n_name</td>
                        <td>$sold</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="container">
  <h3 class="text-center text-success">Recommended Plants</h3>
  <div class="row">
    <?php
    $query = "SELECT p.plant_name, p.image, p.price FROM plants p 
    WHERE p.category_id in (SELECT category_id FROM orders o 
    JOIN order_plants op ON o.order_id = op.order_id JOIN plants p ON p.plant_id=op.plant_id 
    WHERE o.cust_id =$cust_id GROUP BY category_id ORDER BY COUNT(*) DESC) 
    ORDER BY p.price";
    $result = mysqli_query($con, $query);
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
      $image = $row['image'];
      $plant_name = $row['plant_name'];
      $price = $row['price'];
      if ($count % 3 == 0 && $count != 0) {
        echo '</div><div class="row">';
      }
      echo '
      <div class="col-md-4">
        <div class="card" style="width: 100%; height: 100%;">
          <img src="../images/' . $image . '" class="card-img-top" alt="' . $plant_name . '">
          <div class="card-body">
            <h4 class="card-title">' . $plant_name . '</h4>
            <h6 class="card-text">Price - ' . $price . '</h6>
          </div>
        </div>
      </div>';
      $count++;
    }
    ?>
  </div>
</div>


</body>
</html>

    