<div class="flex flex-row flex-wrap justify-center">
    <div class="w-10/12 sm:w-8/12 md:w-5/12">
        <?php

        use App\Core\Currency;

        if ($product->image) : ?>
            <img src="<?= storage_url($product->image) ?>" class="w-full rounded-xl shadow-xl" alt="<?= $product->title ?>">
        <?php endif ?>
    </div>
    <div class="w-full md:w-7/12 md:pl-8 mt-6 md:mt-0 text-center md:text-left">
        <h2 class="text-3xl mb-4 font-semibold"><?= $product->title ?></h2>
        <p class="mb-4"><?= Currency::$instance->format($product->price, 'text-2xl') ?></p>
        <p class="mb-2">ID: <?= $product->id ?></p>
        <p class="mb-2">
            <?= translate('Status') ?>: <?= $product->quantity >= 1
                                            ? '<span class="font-semibold text-green-400">' . translate('In Stock') . '</span>'
                                            : '<span class="font-semibold text-rose-400">' . translate('Out of Stock') . '</span>' ?>
        </p>
        <p class="mb-6">
            <?= translate('Category') ?>: <a href="<?= $product->category->getSlug() ?>" class="text-xamber-700 hover:text-xamber-800"><?= $product->category->title ?></a>
        </p>
        <?php $this->component('components.cart-button', [
            'product' => $product,
            'customize' => true,
            'class' => [
                'parent' => 'flex font-semibold justify-center md:justify-start',
                'button' => 'font-semibold px-4 py-2 rounded-l-none',
                'icon' => 'w-6'
            ]
        ]) ?>
    </div>
</div>