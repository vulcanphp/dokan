<?php

use App\Core\Payments\Payments;

$paypal = Payments::$instance->getPayment('paypal');
?>

<div x-data='{isPayPalLoading: true}' x-init='let payPalObject = function () {
        paypal.Button.render({
            env: "<?= $paypal->getConfig('env') ?>",
            client: {
                sandbox: "<?= $paypal->getConfig('client_id') ?>",
                production: "<?= $paypal->getConfig('client_id') ?>"
            },
            locale: "en_US",
            style: {
                size: "responsive",
                color: "black",
                shape: "pill",
                tagline: false
            },
            payment: function (data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: getCartTotal().toFixed(currency.decimal),
                            currency: currency.code
                        },
                        description: getOrderedProductDescription()
                    }]
                });
            },
            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function () {
                    placeOrder(data);
                });
            }
        }, "#paypalContainer"), setTimeout(() => isPayPalLoading = false, 1000);
    }
    if((window.paypalInitialized ?? null) == null) {
        window.paypalInitialized = true;
        loadScript("https://www.paypalobjects.com/api/checkout.js", payPalObject);
    }else{
        payPalObject();
    }'>
    <!-- Paypal Element will be inserted here. -->
    <template x-if="isPayPalLoading">
        <div class="animate-pulse rounded-full h-10 w-full bg-xbg-700 mt-8"></div>
    </template>
    <div x-cloak x-show="!isPayPalLoading" id="paypalContainer" class="mt-8"></div>
</div>