<?php

use App\Core\Currency;
?>
<div class="mt-4 bg-xbg-700 hover:bg-xbg-600 p-3 rounded-md transition ease-in-out duration-150 <?= $product->quantity < 1 ? 'opacity-75' : '' ?>">
    <a href="<?= $product->getSlug() ?>">
        <img src="<?= storage_url($product->imageSize(400, 400)) ?>" alt="<?= $product->title ?><" class="w-full h-auto md:h-40 object-cover rounded">
    </a>
    <div class="mt-2">
        <div class="mb-1">
            <?= Currency::$instance->format($product->price) ?>
        </div>
        <a href="<?= $product->getSlug() ?>" class="font-semibold"><?= $product->title ?></a>
        <?php $this->component('components.cart-button', [
            'product' => $product,
            'customize' => false,
            'class' => ['button' => 'justify-center mx-auto text-sm', 'icon' => 'w-5', 'parent' => 'text-center']
        ]) ?>
    </div>
</div>