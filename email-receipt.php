<?php
require("db_conn.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_GET['bookingid'])) {
        $id = $_GET['bookingid'];
    }

    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['user_name'];
        $clientname = $row['client_name'];
        $cars_name = $row['cars_name'];
        $phonenum = $row['phone_num'];
        $fullname = $row['full_name'];
        $email = $row['email'];
        $days_rented = $row['days_rented'];
        $deposit = $row['deposit'];
        $total = $row['total'];
        $total_clean = str_replace(['RM', ' ', ','], '', $total); 
        $deposit_clean = str_replace(['RM', ' ', ','], '', $deposit); 

        $total_price = (float)$total_clean - (float)$deposit_clean;
        $price_string = $total_price / $days_rented;

        $invoice_no = $row['invoice_no'];
        $date = $row['invoice_date'];

        $mail = require __DIR__ . "/mailer.php";

        $mail->setFrom("mgeek573@gmail.com", "Car Rental Service");
        $mail->addAddress($email);
        $mail->Subject = "Your Rental Receipt";
        $mail->isHTML(true);

        $mail->Body = <<<END
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd;">
            <h2 style="text-align: center;">Car Rental Receipt</h2>
            <p>Thank you for choosing our car rental service. Below are the details of your transaction:</p>
            <hr>
            <h4>Billed To:</h4>
            <p><strong>$fullname</strong><br>$email<br>$phonenum</p>
            <hr>
            <h4>Invoice Details:</h4>
            <p><strong>Invoice No:</strong> $invoice_no<br><strong>Date:</strong> $date</p>
            <hr>
            <h4>Order Summary:</h4>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px;">No.</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Item</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Price (daily)</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Days Rented</th>
                        <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">1</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">$cars_name<br>Rented by $clientname</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">RM $price_string</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">$days_rented</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">RM $total_price</td>
                    </tr>
                </tbody>
            </table>
            <p><strong>Sub Total:</strong>RM $total_price<br><strong>Deposit:</strong> $deposit<br><strong>Total: $total</p> </strong>
            <hr>
            <p style="text-align: center;">Thank you for renting with us!</p>
        </div>
        END;

        try {
            $mail->send();
            echo "<script>alert('Receipt sent successfully'); window.location.href='users/billing.php';</script>";
            exit();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No user found with this email.";
    }
}
