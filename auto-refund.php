<?php
require_once "config.php";
require __DIR__ . "/vendor/autoload.php";
include "db_conn.php";

$stripe_secret_key = "sk_test_51QTMMtGVwmcrp8zonimoHlls0t4nv6Rs9shLy3dqLaohRYrAJDrZ184yiPcimKHLMhxykjgouLVyfjICbTgdFacs005hVgP7st";

\Stripe\Stripe::setApiKey($stripe_secret_key);




$stripe->refunds->create([
    'charge' => $charge_id,
    'amount' => $deposit
]);

http_response_code(303);
header("Location: " . $checkout_session->url);
?>