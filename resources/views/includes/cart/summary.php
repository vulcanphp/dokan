<div class="bg-xbg-600 mb-4 rounded-xl px-4 py-2 md:px-6 md:py-4">
    <template x-for="product in cart">
        <a class="text-sm md:text-base block mb-2" :href="'<?= home_url() ?>-' + product.id">
            <span class="block" x-text="product.title"></span>
            <span class="text-xs text-xamber-700 font-semibold" x-text="' ( x '+ product.reserve + ' = ' + price(product.price * product.reserve) +')'"></span>
        </a>
    </template>
</div>