<?php
/**
 * User: david-adam
 * Date: 22/03/2018
 * Time: 10:52 AM
 */

/**
 * Braintree SDK uses a deprecated function create_function(). to avoid the PHP emit the warning message,
 * add following line or modify the php.ini file
 **/
ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

require __DIR__.'/vendor/autoload.php';

$gateway = new Braintree_Gateway(array(
    'accessToken' => 'access_token$sandbox$dqkytsbccnzqh2g7$f4bec65ef541fe886b7d25014cefd9e6',
    //from my PayPal sandbox linked with Braintree sandbox account ( david.g.adam+seller@gmail.com )
));
