<div class="bg-xbg-700 shadow-xl group p-2 rounded-xl mt-2 <?= $products->count() >= 4 ? 'max-h-[75vh] overflow-y-scroll' : '' ?>">
    <?php
    if (!$products->isEmpty()) {
        foreach ($products->all() as $index => $result) {
            $this->include('ajax.parts.product', ['product' => $result, 'first' => $index == 0]);
        }
    } else {
    ?>
        <p class="text-gray-300 text-lg px-4 py-2 text-center">
            <?= translate('No Products for') ?> "<?= $keyword ?>"
        </p>
    <?php
    }
    ?>
</div>