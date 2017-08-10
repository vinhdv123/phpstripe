<?php
/**
 * Created by PhpStorm.
 * User: vinhdv
 * Date: 8/7/17
 * Time: 5:33 PM
 */

require 'stripe-php/init.php';

$params = array(
    "testmode"   => "on",
    "private_live_key" => "sk_test_OHIs9gBufbrTgkXpJ1ZZ07RK",
    "public_live_key"  => "pk_test_hkgMlnTX0EP0or4OvOBAhZEr",
    "private_test_key" => "sk_test_OHIs9gBufbrTgkXpJ1ZZ07RK",
    "public_test_key"  => "pk_test_hkgMlnTX0EP0or4OvOBAhZEr"
);

if ($params['testmode'] == "on") {
    \Stripe\Stripe::setApiKey($params['private_test_key']);
    \Stripe\Stripe::$apiBase = "https://api-tls12.stripe.com";
    $pubkey = $params['public_test_key'];
} else {
    \Stripe\Stripe::setApiKey($params['private_live_key']);
    \Stripe\Stripe::$apiBase = "https://api-tls12.stripe.com";
    $pubkey = $params['public_live_key'];
}
