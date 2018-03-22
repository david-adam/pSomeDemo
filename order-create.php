<?php
/**
 * Created by PhpStorm.
 * User: david-adam
 * Date: 22/03/2018
 * Time: 12:04 PM
 */

include_once 'bootstrap.php';


$result = $gateway->transaction()->sale([
    'amount' => $_POST['amount'],
    'merchantAccountId' => 'USD',
    'paymentMethodNonce' => $_POST['payment_method_nonce'],
    'orderId' => $_POST['Mapped to Paypal Invoice Number'],
    'descriptor' => [
        'name' =>'Descriptor displayed in customer CC statements. 22 char max'
    ],
    'shipping' =>[
        'firstName'=> '',
        'lastName' => '',
        'company' => '',
        'streetAddress' => '',
        'extendedAddress' => '',
        'locality' => '',
        'region' => '',
        'postalCode' => '',
        'countryCodeAlpha2' => 'US',
    ],
    'options' => [
        'paypal' => [
            'customField' => $_POST['PayPal custom field'],
            'description' => $_POST['Description for PayPal email receipt'],
        ]
    ]
]);


if ($result->success){
    print_r("Success ID: " . $result->transaction->id);
} else {
    print_r("Error Message: " . $result->message);
}
