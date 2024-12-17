$stripe_secret_key = "sk_test_51QTMMtGVwmcrp8zonimoHlls0t4nv6Rs9shLy3dqLaohRYrAJDrZ184yiPcimKHLMhxykjgouLVyfjICbTgdFacs005hVgP7st";
    \Stripe\Stripe::setApiKey($stripe_secret_key);

    if ($stripe_id) {
            $session = \Stripe\Checkout\Session::retrieve($stripe_id);
            $paymentIntentId = $session->payment_intent;
            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);
            $charge_id = !empty($paymentIntent->charges->data) ? $paymentIntent->charges->data[0]->id : null;
    } else {
        echo "No checkout session ID found.";
    }
