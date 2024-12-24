<?php
require_once "config.php";
require __DIR__ . "/vendor/autoload.php";
include "db_conn.php";

if (isset($_GET['bookingid'])) {
    $id = $_GET['bookingid'];

    $total = isset($_SESSION['payment']['total']) ? $_SESSION['payment']['total'] : null;
    $days_rented = isset($_SESSION['payment']['days_rented']) ? $_SESSION['payment']['days_rented'] : null;

    $total_in_sen = $total * 100;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $payment_method = $_POST['payment_method'];
        $status = "Pending";
    
        $_SESSION['info'] = [
            'user_name' => $_POST['user_name'],
            'full_name' => $_POST['full_name'],
            'ic_no' => $_POST['ic_no'],
            'driver_no' => $_POST['driver_no'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'status' => $status,
            'payment_method' => $payment_method,
        ];
    }

    $sql = "SELECT * FROM cars WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
    }

    if ($payment_method == 'Cash') {
        header("Location: cash.php?bookingid=" . $id);
        exit;
    }

}

$stripe_secret_key = "sk_test_51QTMMtGVwmcrp8zonimoHlls0t4nv6Rs9shLy3dqLaohRYrAJDrZ184yiPcimKHLMhxykjgouLVyfjICbTgdFacs005hVgP7st";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/fyp/users/receipt.php?bookingid=" . $id,
    "cancel_url" => "http://localhost/fyp/users/booking-details.php?bookingid=" . $id,
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "myr",
                "unit_amount" => $total_in_sen,
                "product_data" => [ 
                    "name" => "Total amount of Rent for $name in $days_rented days"
                ]
            ]
        ],
    ]
]);

$_SESSION['api'] = [
    'stripe_id' => $checkout_session->id
];

http_response_code(303);
header("Location: " . $checkout_session->url);
?>