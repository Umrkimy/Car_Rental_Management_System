<?php

include "../db_conn.php";


if (isset($_GET['invoiceid'])) {
    $invoiceid = $_GET['invoiceid'];

    $stmt = $conn->prepare("SELECT status FROM bookings WHERE id = ? AND status = 'Pending'");
    $stmt->bind_param("i", $invoiceid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $updateStmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ?");
        $updateStmt->bind_param("i", $invoiceid);
        $updateStmt->execute();

        if ($updateStmt->affected_rows > 0) {
            header("Location: billing.php?status=cancelled");
            exit;
        } else {
            header("Location: billing.php?status=error");
            exit;
        }
    } else {
        header("Location: billing.php?status=not_pending");
        exit;
    }
} else {
    header("Location: billing.php?status=invalid_request");
    exit;
}
?>
