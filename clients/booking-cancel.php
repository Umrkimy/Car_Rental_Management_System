<?php
include "../db_conn.php";
require_once "../vendor/autoload.php";

$stripe_secret_key = "sk_test_51QTMMtGVwmcrp8zonimoHlls0t4nv6Rs9shLy3dqLaohRYrAJDrZ184yiPcimKHLMhxykjgouLVyfjICbTgdFacs005hVgP7st";
\Stripe\Stripe::setApiKey($stripe_secret_key);

if (isset($_GET['cancelid'])) {
    $invoiceid = $_GET['cancelid'];

    $stmt = $conn->prepare("SELECT full_name, email, status, pickup_date, stripe_id, deposit, total FROM bookings WHERE id = ? AND status IN ('Pending', 'Confirmed')");
    $stmt->bind_param("i", $invoiceid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fullname = $row['full_name'];
        $email = $row['email'];
        $pickup_date = $row['pickup_date'];
        $stripe_id = $row['stripe_id'];
        $depositRM = $row['deposit'];
        $totalAmountRM = $row['total'];

        $deposit = (float)str_replace(',', '', str_replace('RM', '', $depositRM));
        $totalAmount = (float)str_replace(',', '', str_replace('RM', '', $totalAmountRM));

        $currentDate = new DateTime();
        $pickupDate = new DateTime($pickup_date);
        $diff = $pickupDate->diff($currentDate);

        if ($diff->days > 1) {
            $amountToRefund = $totalAmount * 100;
        } else {
            $amountToRefund = ($totalAmount - $deposit) * 100;
        }

        if ($stripe_id) {
            try {
                $checkout_session = \Stripe\Checkout\Session::retrieve($stripe_id);
                $payment_intent_id = $checkout_session->payment_intent;

                if (!$payment_intent_id) {
                    echo "No Payment Intent found for booking ID " . $invoiceid . "<br>";
                    exit;
                }

                $refund = \Stripe\Refund::create([
                    'payment_intent' => $payment_intent_id,
                    'amount' => $amountToRefund,
                ]);

                date_default_timezone_set('Asia/Kuala_Lumpur');
                $kuala_lumpur_time = date('Y-m-d H:i:s');

                $updateQuery = "UPDATE bookings SET status = 'Cancelled', refund_id = ?, refund_date = ?, refund_total = ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ssss", $refund->id, $kuala_lumpur_time, $totalAmountRM, $invoiceid);
                $updateStmt->execute();

                // Sending cancellation email
                $mail = require __DIR__ . "/../mailer.php";

                try {
                    $mail->setFrom('mgeek573@gmail.com', 'Car Rental Service');
                    $mail->addAddress($email);
                    $mail->Subject = "Booking Cancellation";
                    $mail->isHTML(true);

                    $mail->Body = <<<END
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd;">
                        <h2 style="text-align: center;">Booking Cancellation</h2>
                        <p>Dear $fullname,</p>
                        <p>We regret to inform you that your booking has been canceled. Here are the details:</p>
                        <hr>
                        <p><strong>Booking ID:</strong> $invoiceid</p>
                        <p><strong>Refund Amount:</strong> RM $totalAmountRM</p>
                        <p><strong>Date of Cancellation:</strong> $kuala_lumpur_time</p>
                        <hr>
                        <p style="text-align: center;">We apologize for any inconvenience caused. Please contact us for further assistance.</p>
                    </div>
                    END;

                    $mail->send();
                } catch (Exception $e) {
                    echo "Cancellation email could not be sent: {$mail->ErrorInfo}";
                }

                header("Location: booking.php?status=cancelled");
                exit;
            } catch (\Stripe\Exception\ApiErrorException $e) {
                echo "Error processing refund for booking ID " . $invoiceid . ": " . $e->getMessage() . "<br>";
                exit;
            }
        } else {
            echo "No Stripe ID found for booking ID " . $invoiceid . "<br>";
            exit;
        }
    } else {
        header("Location: booking.php?status=not_pending");
        exit;
    }
} else {
    header("Location: booking.php?status=invalid_request");
    exit;
}
