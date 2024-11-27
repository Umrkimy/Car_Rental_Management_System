<?php
include "../db_conn.php";

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM cars WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("Location: cars.php");
        exit; 
    } else {
        die(mysqli_error($conn));
    }
}
?>
