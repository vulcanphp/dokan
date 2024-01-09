<table class="bg-xbg-600 rounded-xl w-full">
    <tr>
        <th class="p-1 text-right"><?= translate('Subtotal') ?></th>
        <td class="p-1">
            <p class="ml-2" x-text="price(cartSubtotal())"></p>
        </td>
    </tr>
    <tr>
        <th class="p-1 text-right"><?= translate('Shipping') ?></th>
        <td class="p-1">
            <p class="ml-2" x-text="price(shipping)"></p>
        </td>
    </tr>
    <tr>
        <th class="p-1 text-right"><?= translate('VAT') ?></th>
        <td class="p-1">
            <p class="ml-2" x-text="price(getVatCost()) + ' (' + vat + '%)'"></p>
        </td>
    </tr>
    <tr class="border-t border-gray-400">
        <th class="p-1 text-right"><?= translate('Total') ?></th>
        <td class="p-1">
            <p class="ml-2" x-text="price(getCartTotal())"></p>
        </td>
    </tr>
</table>