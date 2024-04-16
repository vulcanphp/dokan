<?php if (!empty($related)) : ?>
    <h3 class="mt-8 mb-2 text-xamber-700 text-2xl font-semibold"><?= translate('Related Products') ?></h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <?php foreach ($related as $product) : ?>
            <?php $this->component('components.product-list', ['product' => $product]) ?>
        <?php endforeach ?>
    </div>
<?php endif ?>