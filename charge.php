<?php
/**
 * Created by PhpStorm.
 * User: vinhdv
 * Date: 8/7/17
 * Time: 5:33 PM
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Stripe library

require_once 'config.php';

if (isset($_POST['stripeToken'])) {

    $amount_cents = str_replace(".", "", "10.52");  // Chargeble amount
    $invoiceid = "14526321";                      // Invoice ID
    $description = "Invoice #" . $invoiceid . " - " . $invoiceid;
    try {
        $charge = \Stripe\Charge::create(array(
            'source' => $_POST['stripeToken'],
            'amount' => 1000,
            "description" => "Event charge",
            'currency' => 'usd',
            'receipt_email' => 'ipmac.vinhdv@gmail.com',
            "application_fee" => 123
        ));
        echo '<pre>';
        var_dump($charge->id);die;
//        echo '<h1>Successfully charged $50.00!</h1>';
    } catch (\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err = $body['error'];

        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");
    } catch (\Stripe\Error\RateLimit $e) {
        print('Status is:' . $e->getMessage() . "\n");
    } catch (\Stripe\Error\InvalidRequest $e) {
        print('Status is:' . $e->getMessage() . "\n");
    } catch (\Stripe\Error\Authentication $e) {
        print('Status is:' . $e->getMessage() . "\n");
    } catch (\Stripe\Error\ApiConnection $e) {
        print('Status is:' . $e->getMessage() . "\n");
    } catch (\Stripe\Error\Base $e) {
        print('Status is:' . $e->getMessage() . "\n");
    } catch (Exception $e) {
        print('Status is:' . $e->getMessage(). "\n");
    }
    die;
}