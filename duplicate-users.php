<?php
require_once "config.php";
include "db_conn.php"; 

if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = urldecode($_GET['email']);

 
    $sql = "SELECT user_name, id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['id'] = $row['id'];

        header("Location: users");
        exit();
    } 
} 
?>
