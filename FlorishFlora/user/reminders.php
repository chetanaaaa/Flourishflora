<!DOCTYPE html>
<html>
<head>
    <title>My Reminders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .reminder {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
            box-shadow: 2px 2px 5px #ccc;
        }

        .reminder p {
            margin: 0;
        }

        .reminder-date {
            font-weight: bold;
        }
    </style>

</head>
<body>
    <h2 class="text-success">My Reminders</h2>
    
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
        $original_date=$row['reminder_date'];
        $formatted_date = date("F j, Y", strtotime($original_date));
        echo "<div class='reminder'>
            <p class='reminder-date'> Reminder Date : $formatted_date</p>
            <p>" .$row['reminder_message']."</p>
        </div>";

        }
    } else {
        echo "No reminders";
    }
    ?>
</body>
</html>
