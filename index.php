<?php
/**
 * Braintree SDK uses a deprecated function create_function(). to avoid the PHP emit the warning message,
 * add following line or modify the php.ini file
 **/
ini_set('error_reporting',E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

require __DIR__.'/vendor/autoload.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('vqg6vfdz5j46wtqt');
Braintree_Configuration::publicKey('byj8r6qwkyw8z469');
Braintree_Configuration::privateKey('429de2dea73251000d2c7c14c164a861');

if(isset($_POST['hidden-nonce'])){

    // For simplicity, omit the data security check ( validation and filtering ). On prod env, all posted data should
    // be checked.
    $result = Braintree\Transaction::sale([
            'amount'=> $_POST['amount'],
            'paymentMethodNonce'=> $_POST['hidden-nonce'],
            'shipping' =>[
                'firstName'=> $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'streetAddress' => $_POST['streetAddress'],
                'extendedAddress' => $_POST['extendeAddress'],
                'locality' => $_POST['city'],
                'region' => $_POST['region'],
                'postalCode' => $_POST['postalCode'],
                'countryCodeAlpha2' => $_POST['countryCodeAlpha2'],
            ],
            'options' => [
                    'submitForSettlement' => true
            ]
    ]);


    if(isset($result->errors)){
        $errorString = "";
        foreach ($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }
    }

    if(!$result->success) { echo "Error Message: " . $result->message; }

    if($result->success && !is_null($result->transaction)){
        echo "Sccess ID: " . $result->transaction->id;
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submit Your Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
    <script src="https://js.braintreegateway.com/web/3.25.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.25.0/js/paypal-checkout.min.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
</head>
<body>
<section class="section">
        <div class="container is-fluid">
            <h1 class="title">
                Demo of Paypal Express Checkout and Braintree integration
            </h1>
            <div class="notification">
                Due to <strong>time constrain</strong>, only valid the order amount on this checkout form. Since
                the shipping address validation seems involves addtional paypal api check, for this demo, the
                address info is hard-coded as a US address.
            </div>
            <div>
                <form method="post" action="#">

                    <div class="field">
                        <label class="label">Amount</label>
                        <div class="control">
                            <input name="amount" id="amount" class="input" type="text" placeholder="Amount in USD">
                        </div>
                    </div>
                    <nav class="panel">
                        <p class="panel-heading">
                            Shipping Address
                        </p>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">First Name</label>
                                <div class="control">
                                    Wei
                                    <input type="hidden" name="firstName" id="firstName" value="Wei">
                                    <!--<input name="firstName" id="firstName" type="text" placeholder="First Name">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Last Name</label>
                                <div class="control">
                                    Dai
                                    <input type="hidden" name="lastName" id="lastName" value="Dai">
                                    <!--<input name="lastName" id="lastName" class="input" type="text" placeholder="Last Name">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Phone</label>
                                <div class="control">
                                    123.456.7890
                                    <input type="hidden" name="phone" id="phone" value="123.456.7890">
                                    <!--<input name="company" id="company" class="input" type="text" placeholder="Company">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Street Address</label>
                                <div class="control">
                                    1234 Main St.
                                    <input type="hidden" name="streetAddress" id="streetAddress" value="1234 Main St.">
                                    <!--<input name="streetAddress" id="streetAddress" class="input" type="text" placeholder="Street Address">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Extended Addressame</label>
                                <div class="control">
                                    Unit 1
                                    <input type="hidden" name="extendedAddress" id="extendedAddress" value="Unit 1">
                                    <!--<input name="extendedAddress" id="extendedAddress" class="input" type="text" placeholder="Extended Address">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">City</label>
                                <div class="control">
                                    Chicago
                                    <input type="hidden" name="city" id="city" value="Chicago">
                                    <!--<input name="city" id="city" class="input" type="text" placeholder="City">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Region</label>
                                <div class="control">
                                    Il
                                    <input type="hidden" name="region" id="region" value="Il">
                                    <!--<input name="region" id="region" class="input" type="text" placeholder="Region">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Postal Code</label>
                                <div class="control">
                                    60652
                                    <input type="hidden" name="postalCode" id="postalCode" value="60652">
                                    <!--<input name="postalCode" id="postalCode" class="input" type="text" placeholder="Postal Code">-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-block">
                            <div class="field">
                                <label class="label">Country</label>
                                US
                                <input type="hidden" name="countryCodeAlpha2" id="countryCodeAlpha2" value="US">
                                <!--<div class="select">
                                    <select title="Country" id="countryCodeAlpha2" name="countryCodeAlpha2">
                                        <option value="US">US</option>
                                        <option value="GB">GB</option>
                                    </select>
                                </div>-->
                            </div>
                        </div>
                    </nav>

                    <input type="hidden" name="hidden-nonce" id="hidden-nonce">


                </form>
                <p id="msgFormValidation" class="notification is-danger" style="display: none">Please enter an amount in a numeric value that is bigger than 0 !</p>
                <div class="field is-grouped">
                    <div class="control">
                        <div id="paypal-button"></div>
                    </div>
                </div>
            </div>
        </div>
</section>

<script>


    function isFormValid() {
        var amount = Number($('#amount').val());
        return (amount !== '') && (!(isNaN(Number(amount))) && (Number(amount) > 0) );
    }

    function toggleValidationMessage() {
        var errorMessage = $('#msgFormValidation');

        isFormValid() ? errorMessage.hide() : errorMessage.show();
    }

    function toggleButton(actions) {
        return isFormValid() ? actions.enable() : actions.disable();
    }

    //Create a client.
    braintree.client.create({
        authorization: '<?php echo Braintree_ClientToken::generate(); ?>'
    }, function (clientErr, clientInstance) {

        // Stop if there was a problem create the client.
        // This could happen if there is a network error or if the authorization
        // is invalid.
        if(clientErr){
            console.error('Error creating client:', clientErr);
            return;
        }

        //Create a Paypal Checkout component.
        braintree.paypalCheckout.create({
            client: clientInstance
        }, function (paypalCheckoutErr, paypalCheckoutInstance) {

            // Stop if there was a problem creating Paypal checkout.
            // This could happen if there was a network error of if it's incorrectly configured.
            if(paypalCheckoutErr){
                console.error('Error creating Paypal Checkout:', paypalCheckoutErr);
                return;
            }

            // Set up Paypal with checkout.js library
            paypal.Button.render({
                env: 'sandbox', // Or 'production'
                commit: true, // This will add the transaction amount to the PayPal button

                payment: function () {
                    return paypalCheckoutInstance.createPayment({
                        flow: 'checkout', //Required
                        amount: $('#amount').val(), //Required
                        currency: 'USD', // Required
                        locale: 'en_US',
                        enableShippingAddress: true,
                        shippingAddressEditable: false
                    });
                },

                validate: function(actions) {
                    toggleButton(actions);

                    $('#amount').blur(function () {
                        toggleButton(actions);
                    })

                },

                onClick: function() {
                    toggleValidationMessage();
                },

                onAuthorize: function (data, actions) {
                    return paypalCheckoutInstance.tokenizePayment(data)
                        .then(function(payload) {
                            $('#hidden-nonce').val(payload.nonce);
                            $('form').submit();
                        });
                },

                onCancel: function (data) {
                    console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
                },

                onError: function(err) {
                    console.error('checkout.js error:', err);
                }
            }, "#paypal-button").then(function () {

                // The Paypal button will be rendered in an html element with the id
                // 'paypal-button'. This function will be called when the Paypal button is set up
                // and ready to be used.

            });

        });
    });
</script>
</body>
</html>
