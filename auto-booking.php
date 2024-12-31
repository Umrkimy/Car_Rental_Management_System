<?php
include "db_conn.php";

$sql = "UPDATE bookings 
        SET status = 'Completed' 
        WHERE status = 'Confirmed' 
        AND status NOT IN ('Refunded', 'Cancelled') 
        AND dropoff_date <= CURDATE()";

if ($conn->query($sql) === TRUE) {
    header("Location: admins");
        exit;
} else {
    echo "Error updating records: " . $conn->error;
}

$conn->close();
?>