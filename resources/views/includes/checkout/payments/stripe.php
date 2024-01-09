<?php

use App\Core\Payments\Payments;

$stripe = Payments::$instance->getPayment('stripe');
?>

<div x-data="{
        stripe: null,
        card: null,
        isStripeLoading: true,
        payStripe() {
            var options = {
                name: $refs.billingForm.name.value,
                address_line1: $refs.billingForm.address.value
            }
            this.stripe.createToken(this.card, options).then(function(result) {
                if (result.error) {
                    document.querySelector('#stripe-errors').innerHTML = result.error.message;
                } else {
                    placeOrder(result);
                }
            });
        }
    }" x-init="let stripeElement = function() {
            stripe = Stripe('<?= $stripe->getConfig('publishable_key') ?>');
            card = stripe.elements().create('card', {
                style: {
                    base: {
                        color: '#94a3b8',
                        iconColor: '#e2e8f0',
                        lineHeight: '18px',
                        fontFamily: 'Montserrat Upload, Sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#cbd5e1'
                        }
                    },
                    invalid: {
                        color: '#f87171',
                        iconColor: '#fca5a5'
                    }
                },
                hidePostalCode: true
            });
            card.mount('#stripe-card-element');
            card.on('change', function(event) {
                if (event.error) {
                    document.querySelector('#stripe-errors').innerHTML = event.error.message;
                } else {
                    document.querySelector('#stripe-errors').innerHTML = '';
                }
            });
            setTimeout(() => isStripeLoading = false, 1000);
        }
        if((window.stripeInitialized ?? null) == null) {
            window.stripeInitialized = true;
            loadScript('https://js.stripe.com/v3/', stripeElement);
        }else{
            stripeElement();
        }" class="mt-8">
    <template x-if="isStripeLoading">
        <div class="animate-pulse rounded-full h-10 w-full bg-xbg-700 mt-8"></div>
    </template>
    <div x-cloak x-show="!isStripeLoading">
        <!-- Stripe Element will be inserted here. -->
        <div id="stripe-card-element" class="bg-xbg-700 px-4 py-3 rounded-full"></div>
        <!-- Used to display stripe errors -->
        <div id="stripe-errors" class="text-rose-400 mt-2 font-semibold"></div>
    </div>
    <div class="text-center mt-8">
        <button type="button" @click="payStripe()" class="bg-xamber-700 uppercase hover:bg-xamber-800 px-6 py-2 md:px-8 md:py-3 rounded-full font-semibold text-lg md:text-xl inline-block"><?= translate('Pay Now') ?></button>
    </div>
</div>