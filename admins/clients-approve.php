<?php
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'verified') {
        $status = 'Verified';
    } elseif ($action === 'reject') {
        $status = 'Rejected';
    } else {
        echo "Invalid action.";
        exit();
    }

    $sql = "UPDATE clients SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        header("Location: clients-status.php");
    }
}
?>
