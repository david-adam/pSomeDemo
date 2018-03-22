<?php
/**
 * Created by PhpStorm.
 * User: david-adam
 * Date: 22/03/2018
 * Time: 11:57 AM
 */

include_once 'bootstrap.php';

echo($clientToken = $gateway->clientToken()->generate());
