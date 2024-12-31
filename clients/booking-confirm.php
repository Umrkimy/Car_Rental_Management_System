<?php
include "../db_conn.php";

if (isset($_GET['confirmid'])) {
    $id = $_GET['confirmid'];

    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $fullname = $row['full_name'];
        $email = $row['email'];
        $invoice_no = $row['invoice_no'];
        $cars_name = $row['cars_name'];
        $date = date("Y-m-d");

        $status = "Confirmed";

        $updateSql = "UPDATE bookings SET status = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ss", $status, $id);

        if (mysqli_stmt_execute($updateStmt)) {
            $mail = require __DIR__ . "/../mailer.php";

            try {

                $mail->setFrom('mgeek573@gmail.com', 'Car Rental Service');
                $mail->addAddress($email);
                $mail->Subject = "Booking Confirmation";
                $mail->isHTML(true);

                $mail->Body = <<<END
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd;">
                    <h2 style="text-align: center;">Booking Confirmation</h2>
                    <p>Dear $fullname,</p>
                    <p>We are pleased to confirm your booking. Here are the details:</p>
                    <hr>
                    <p><strong>Invoice No:</strong> $invoice_no</p>
                    <p><strong>Car:</strong> $cars_name</p>
                    <p><strong>Date of Confirmation:</strong> $date</p>
                    <hr>
                    <p style="text-align: center;">Thank you for choosing our service!</p>
                </div>
                END;

                $mail->send();
                echo "<script>alert('Booking confirmed and email sent successfully'); window.location.href='booking.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Booking confirmed but email could not be sent: {$mail->ErrorInfo}'); window.location.href='booking.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to update booking status'); window.location.href='booking.php';</script>";
        }
    } else {
        echo "<script>alert('No booking found with this ID'); window.location.href='booking.php';</script>";
    }
}
?>
