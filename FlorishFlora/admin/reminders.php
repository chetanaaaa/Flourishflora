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
    <form action="" method="POST" accept-charset="UTF-8">
        <div class="input-group  w-10 mb-2">
  <div class="input-group  w-10 mb-2">
  <span class="input-group-text bg-success" id="basic-addon1">
    <i class="fa-solid fa-receipt"></i></span>
  <input type="number" class="form-control" name="day_interval" placeholder="Enter Day Interval" required>
  </div>
  <br><br>
<div class="input-group  w-10 mb-2">
  <div class="input-group  w-90 mb-2">
  <span class="input-group-text bg-success" id="basic-addon1">
    <i class="fa-solid fa-receipt"></i></span>
    <textarea name="reminder_message" rows="4" cols="100" required placeholder="Add reminder message"></textarea>
  </div>
<div class="input-group  w-10 mb-2">
  
<input type="submit" class="bg-success border-0 p-2 my-3" name="add_rem" value="Add Reminders">

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
