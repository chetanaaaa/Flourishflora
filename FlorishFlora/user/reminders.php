<!DOCTYPE html>
<html>
<head>
    <title>My Reminders</title>
</head>
<body>
    <h1>My Reminders</h1>
    
    <?php

if(isset($_SESSION['email'])){
$email=$_SESSION['email'];
$selectq="select * from user_table where email='$email'";
$user_res=mysqli_query($con,$selectq);
$user_row=mysqli_fetch_array($user_res);
$fname=$user_row['fname'];
$cust_id=$user_row['cust_id'];
}

$current_date = date('Y-m-d');
// Retrieve reminders for the user on the current date
    $query = "SELECT * FROM reminders WHERE customer_id = $cust_id and DATE(reminder_date) <= '$current_date'";
    $result = mysqli_query($con,$query);
    $num=mysqli_num_rows($result);
    if ($num>0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>Date: " .$row['reminder_date']. ", Message: " .$row['reminder_message']. "</li>";
        }
    } else {
        echo "No reminders found for this user.";
    }
    ?>
</body>
</html>
