<section class="mt-5">
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 md:gap-5">
        <?php foreach ($products->getData() as $product) : ?>
            <?php $this->component('components.product-card', ['product' => $product]) ?>
        <?php endforeach ?>
    </div>
    <?php if (!$products->hasData()) : ?>
        <div class="text-center my-6">
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-300"><?= translate('Products Unavailable') ?></h2>
        </div>
    <?php endif ?>
    <?php if ($products->hasLinks()) : ?>
        <div class="mt-6 flex justify-center">
            <?= $products->getLinks(1) ?>
        </div>
    <?php endif ?>
</section>