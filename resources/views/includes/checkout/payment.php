<?php

use App\Core\Payments\Payments;

?>
<?php if (Payments::$instance->hasPayments()) : ?>
    <div x-data='{
    method: "<?= Payments::$instance->getDefaultPayment()->getId() ?>",
    placeOrder(payment) {
        ($refs.billingForm.payment.value = JSON.stringify(payment)), submitForm();
    },
    getOrderedProductDescription() {
        let description = "";
        for(var i = 0; i < cart.length; i++){
            description += (i > 0 ? ((i + 1) == cart.length ? " and " : ", ") : "") + cart[i].title + " (x"+ cart[i].reserve +")";
        }
        return description;
    },
    loadScript(url, callback) {
	    var script = document.createElement("script")
	    script.type = "text/javascript";
	    if (script.readyState) {
	        script.onreadystatechange = function() {
	            if (script.readyState === "loaded" || script.readyState === "complete") {
	                script.onreadystatechange = null;
	                callback();
	            }
	        };
	    } else {
	        script.onload = function() {
	            callback();
	        };
	    }
	    script.src = url;
	    document.getElementsByTagName("head")[0].appendChild(script);
	}
}'>
        <h2 class="text-2xl text-center md:text-left font-semibold mb-4"><?= translate('Payment Option') ?></h2>
        <input type="hidden" name="payment">
        <?php foreach (Payments::$instance->getPayments() as $payment) : ?>
            <div class="flex items-center mb-1">
                <input type="radio" id="<?= $payment->getId() ?>" name="method" x-model="method" value="<?= $payment->getId() ?>" class="w-4 h-4">
                <label for="<?= $payment->getId() ?>" class="ml-2 cursor-pointer text-gray-300 font-semibold"><?= $payment->getTitle() ?></label>
            </div>
            <div x-cloak x-show="method == '<?= $payment->getId() ?>'" class="bg-xbg-700 px-4 py-2 rounded-xl mb-4 text-sm mt-2">
                <p><?= translate($payment->getDescription()) ?></p>
            </div>
        <?php endforeach ?>
        <?php foreach (Payments::$instance->getPayments() as $payment) : ?>
            <template x-if="method == '<?= $payment->getId() ?>'">
                <?= $payment->getView() ?>
            </template>
        <?php endforeach ?>
    </div>
<?php else : ?>
    <div class="bg-xbg-600 text-center px-8 py-4 rounded-2xl opacity-75">
        <span class="text-lg font-semibold">Sorry, There Is Not Any Method To Proceed Your Order Now.</span>
    </div>
<?php endif ?>