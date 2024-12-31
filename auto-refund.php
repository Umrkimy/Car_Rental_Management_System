<?php
require_once "config.php";
require __DIR__ . "/vendor/autoload.php";
include "db_conn.php";

$stripe_secret_key = "sk_test_51QTMMtGVwmcrp8zonimoHlls0t4nv6Rs9shLy3dqLaohRYrAJDrZ184yiPcimKHLMhxykjgouLVyfjICbTgdFacs005hVgP7st";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$query = "SELECT id, stripe_id, deposit, status FROM bookings WHERE status = 'Completed'";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    header("Location: admins");
    exit;
}

$refunds_processed = 0;

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $stripe_id = $row['stripe_id'];
    $depositRM = $row['deposit'];
    $deposit = (float)str_replace(',', '', str_replace('RM', '', $depositRM));
    $deposit_in_cent = $deposit * 100;

    if (!$stripe_id) {
        echo "No Stripe ID found for booking ID " . $id . "<br>";
        continue;
    }

    try {
        $checkout_session = \Stripe\Checkout\Session::retrieve($stripe_id);
        $payment_intent_id = $checkout_session->payment_intent;

        if (!$payment_intent_id) {
            echo "No Payment Intent found for booking ID " . $id . "<br>";
            continue;
        }

        $refund = \Stripe\Refund::create([
            'payment_intent' => $payment_intent_id,
            'amount' => $deposit_in_cent,
        ]);

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $kuala_lumpur_time = date('Y-m-d H:i:s');

        $update_query = "UPDATE bookings SET status = 'Refunded', refund_id = ?, refund_date = ?, refund_total = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssss", $refund->id, $kuala_lumpur_time, $depositRM, $id);
        $update_stmt->execute();
        $update_stmt->close();

        $refunds_processed++;
    } catch (\Stripe\Exception\ApiErrorException $e) {
        echo "Error processing refund for booking ID " . $id . ": " . $e->getMessage() . "<br>";
    }
}

$stmt->close();
$conn->close();

if ($refunds_processed > 0) {
    header("Location: admins");
    exit;
} else {
    header("Location: admins");
    exit;
}
?>
