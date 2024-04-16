<?php

use App\Core\Configurator;
use App\Core\Currency;
?>

<section x-data='{
    currency: <?= json_encode(Currency::$instance->getCurrency(), JSON_UNESCAPED_UNICODE) ?>,
    price(price) {
        return this.currency.symbol_native + " " + (price).toFixed(this.currency.decimal);
    },
    shipping: <?= Configurator::$instance->get('shipping', 0) ?>,
    vat: <?= Configurator::$instance->get('vat', 0) ?>,
    cartSubtotal() {
        var total = 0;
        for(var i = 0; i < this.cart.length; i++){
            total += (this.cart[i].price * this.cart[i].reserve);
        }
        return total;
    },
    getVatCost() {
        return this.vat > 0 ? ((this.cartSubtotal() / 100) * this.vat) : 0;
    },
    getCartTotal() {
        return this.cartSubtotal() + this.shipping + this.getVatCost();
    }
}'>