<?php
/**
 * Created by PhpStorm.
 * User: david-adam
 * Date: 22/03/2018
 * Time: 12:04 PM
 */
/**
 * Braintree SDK uses a deprecated function create_function(). to avoid the PHP emit the warning message,
 * add following line or modify the php.ini file
 **/
ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include_once 'bootstrap.php';

/* PayPal checkoutJS call BrainTree client using access token and client token, seem no need following?

    The transation won't show up in the BrainTree sandbox account. https://sandbox.braintreegateway.com

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('vqg6vfdz5j46wtqt');
Braintree_Configuration::publicKey('byj8r6qwkyw8z469');
Braintree_Configuration::privateKey('429de2dea73251000d2c7c14c164a861');


*/

$result = $gateway->transaction()->sale([
    'amount' => $_POST['amount'],
    'merchantAccountId' => 'USD',
    'paymentMethodNonce' => $_POST['hidden-nonce'],
    'orderId' => "123" . random_int(10, 100),
    'descriptor' => [
        'name' =>'abc*myproduc'
    ],
    'shipping' =>[
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "streetAddress" => $_POST['streetAddress'],
        "extendedAddress" => $_POST['extendeAddress'],
        "locality" => $_POST['city'],
        "region" => $_POST['region'],
        "postalCode" => $_POST['postalCode'],
        "countryCodeAlpha2" => $_POST['countryCodeAlpha2']
    ],
    'options' => [
        'paypal' => [
            'customField' => "customer optional field",
            'description' => "Description for PayPal email receipt",
        ],
        'submitForSettlement' => true
    ]
]);


if ($result->success){
    print_r("Success ID: " . $result->transaction->id);
} else {
    print_r("Error Message: " . $result->message);
}
