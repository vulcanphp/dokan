<div class="bg-xbg-700 border border-xbg-600 rounded-xl mb-4">
    <template x-for="(product, index) in cart">
        <div x-init="((index + 1) == cart.length) && window.fireView.checkFireLinks()">
            <a fire class="text-sm md:text-base flex px-3 py-2 md:px-4 md:py-3" :class="index != 0 && 'border-t border-xbg-600'" :href="'<?= home_url() ?>-' + product.id">
                <img :src="'<?= storage_url() ?>' + product.image" class="w-11 h-11 rounded" :alt="product.title">
                <div class="ml-2">
                    <span class="block" x-text="product.title"></span>
                    <span class="text-xs text-xamber-700 font-semibold" x-text="' ( x '+ product.reserve + ' = ' + price(product.price * product.reserve) +')'"></span>
                </div>
            </a>
        </div>
    </template>
</div>