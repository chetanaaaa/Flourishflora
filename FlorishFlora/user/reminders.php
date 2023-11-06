<!DOCTYPE html>
<html>
<head>
    <title>My Reminders</title>
</head>
<body>
    <h1>My Reminders</h1>
    
    <?php
    // Query to retrieve reminders for the user (assuming user_id is known)
    $user_id = 123; // Replace with the actual user ID

    $query = "SELECT * FROM reminders WHERE customer_id = $user_id";

    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Date: " . $row['reminder_date'] . ", Message: " . $row['reminder_message'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No reminders found for this user.";
    }
    ?>
</body>
</html>
