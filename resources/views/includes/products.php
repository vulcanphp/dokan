<section class="mt-5">
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        <?php foreach ($products->getData() as $product) : ?>
            <?php $this->component('components.product-card', ['product' => $product]) ?>
        <?php endforeach ?>
    </div>
    <?php if (!$products->hasData()) : ?>
        <div class="text-center my-6">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-300"><?= translate('Products Unavailable') ?></h2>
        </div>
    <?php endif ?>
    <div class="mt-6 flex justify-center">
        <?php if ($products->hasLinks()) : ?>
            <?= $products->getLinks(1) ?>
        <?php endif ?>
    </div>
</section>