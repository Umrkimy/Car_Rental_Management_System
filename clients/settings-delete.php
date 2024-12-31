<?php
include "../db_conn.php";

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

        $delete_sql = "DELETE FROM clients WHERE id = ?";
        $delete_stmt = mysqli_prepare($conn, $delete_sql);

        if ($delete_stmt) {
            mysqli_stmt_bind_param($delete_stmt, 'i', $id);
            mysqli_stmt_execute($delete_stmt);

            if (mysqli_stmt_affected_rows($delete_stmt) > 0) {
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: settings.php");
                exit();
            }
        } else {
            header("Location: settings.php");
                exit();
        }

}