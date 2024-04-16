<div class="bg-xbg-700 border border-xbg-600 rounded-xl">
    <table class="w-full">
        <tr>
            <th class="p-1 text-right"><?= translate('Subtotal') ?></th>
            <td class="p-1">
                <p class="ml-2" x-text="price(cartSubtotal())"></p>
            </td>
        </tr>
        <?php

        use App\Core\Configurator;

        if (Configurator::$instance->has('shipping')) : ?>
            <tr>
                <th class="p-1 text-right"><?= translate('Shipping') ?></th>
                <td class="p-1">
                    <p class="ml-2" x-text="price(shipping)"></p>
                </td>
            </tr>
        <?php endif ?>
        <?php if (Configurator::$instance->has('vat')) : ?>
            <tr>
                <th class="p-1 text-right"><?= translate('VAT') ?></th>
                <td class="p-1">
                    <p class="ml-2" x-text="price(getVatCost()) + ' (' + vat + '%)'"></p>
                </td>
            </tr>
        <?php endif ?>
        <tr class="border-t border-xbg-600">
            <th class="p-1 text-right"><?= translate('Total') ?></th>
            <td class="p-1">
                <p class="ml-2" x-text="price(getCartTotal())"></p>
            </td>
        </tr>
    </table>
</div>