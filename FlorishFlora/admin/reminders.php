<?php
include('../includes/connect.php');

if(isset($_POST['add_rem'])){
    $day_interval = $_POST["day_interval"];
    $reminder_message = $_POST["reminder_message"];
    $query = "INSERT INTO predefined_reminders (day_interval, reminder_message) VALUES ($day_interval, '$reminder_message')";
    $res=mysqli_query($con,$query);
    if($res){
        echo "<script>alert('Predefined reminder added successfully')</script>";
    }else {
        echo "<script>alert('Error in adding reminder')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Predefined Reminder</title>
</head>
<body>
    <h1>Add Predefined Reminder</h1>
    <form action="" method="POST">
        <label for="day_interval">Day Interval:</label>
        <input type="number" name="day_interval" required><br><br>

        <label for="reminder_message">Reminder Message:</label>
        <input type="text" name="reminder_message" required><br><br>

        <input type="submit" name="add_rem" value="Add Reminder">
    </form>
</body>
</html>


<!-- CREATE TRIGGER `insert_reminders` AFTER INSERT ON `orders`
 FOR EACH ROW BEGIN
    INSERT INTO reminders (plant_id, customer_id, reminder_date, reminder_message)
    SELECT
        op.plant_id,
        NEW.cust_id,
        DATE_ADD(NEW.date, INTERVAL pr.day_interval DAY),
        CONCAT(pr.water, ' ', pr.fertiliser, ' ', pr.pruning, ' ', pr.custom)
    FROM order_plants op
    JOIN predefined_reminders pr ON op.plant_id = pr.plant_id
    WHERE op.order_id = NEW.order_id;
END -->