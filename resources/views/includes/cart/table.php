<div class="bg-xbg-700 rounded-xl border border-xbg-600">
    <table class="w-full">
        <thead>
            <tr>
                <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Product') ?></th>
                <th class="px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell"><?= translate('Quantity') ?></th>
                <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Subtotal') ?></th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(product, index) in cart">
                <tr class="border-t border-xbg-600" x-init="((index + 1) == cart.length) && window.fireView.checkFireLinks()">
                    <td class="px-2 py-1 md:px-4 md:py-3">
                        <div class="flex items-center">
                            <button @click="removeCart(product.id)" class="font-semibold inline-block text-xl p-1 md:text-2xl text-rose-300 hover:text-rose-400 mr-1 md:mr-3">×</button>
                            <img :src="'<?= storage_url() ?>' + product.image" class="hidden md:block w-16 h-16 rounded shadow" :alt="product.title">
                            <div class="md:ml-3">
                                <a fire class="text-sm md:text-base" :href="'<?= home_url() ?>-' + product.id" x-text="product.title"></a>
                                <p class="mt-1 text-sm text-xamber-700 font-semibold">
                                    <span x-text="price(product.price * 1)"></span>
                                    <small class="sm:hidden" x-text="'(x'+ product.reserve +')'"></small>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell">
                        <div class="flex justify-center">
                            <button @click="getQuantity(product.id) > 1 && addCart(product, getQuantity(product.id) - 1)" class="bg-xamber-700 hover:bg-xamber-800 px-2 py-1 font-semibold rounded-l-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4" viewBox="0 0 24 24">
                                    <path d="M5 11h14v2H5z"></path>
                                </svg>
                            </button>
                            <input type="number" min="1" :max="product.quantity" readonly :value="getQuantity(product.id)" class="bg-xbg-800 text-center outline-none w-14 px-2 py-1">
                            <button @click="getQuantity(product.id) < product.quantity && addCart(product, getQuantity(product.id) + 1)" class="bg-xamber-700 hover:bg-xamber-800 px-2 py-1 font-semibold rounded-r-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4" viewBox="0 0 24 24">
                                    <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                    <td class="px-2 py-1 md:px-4 md:py-3 text-center">
                        <p class="text-sm md:text-base" x-text="price(product.price * product.reserve)"></p>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>