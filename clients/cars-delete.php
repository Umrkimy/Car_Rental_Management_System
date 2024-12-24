<?php
include "../db_conn.php";

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "SELECT image FROM cars WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $imagePath = $row['image'];
        
        if (file_exists($imagePath)) {
            unlink($imagePath);  
        }
    }

    $sql = "DELETE FROM cars WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: cars.php");
        exit;
    } else {
        die(mysqli_error($conn));
    }
}
?>
