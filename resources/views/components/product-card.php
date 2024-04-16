<?php

use App\Core\Currency;
?>
<div class="mt-4 <?= $product->quantity < 1 ? 'opacity-75' : '' ?>">
    <a fire href="<?= $product->getSlug() ?>">
        <img src="<?= storage_url($product->imageSize(400, 400)) ?>" alt="<?= $product->title ?><" class="w-full h-auto md:h-44 object-cover rounded-t-xl">
    </a>
    <div class="rounded-b-xl px-2 py-3 <?= $product->quantity < 1 ? 'bg-rose-400/5' : 'bg-xbg-700' ?>">
        <div class="mb-1">
            <?= Currency::$instance->format($product->price, 'text-lg') ?>
        </div>
        <a fire href="<?= $product->getSlug() ?>"><?= $product->title ?></a>
        <?php $this->component('components.cart-button', [
            'product' => $product,
            'customize' => false,
            'class' => ['button' => 'justify-center mx-auto text-sm', 'icon' => 'w-5', 'parent' => 'text-center']
        ]) ?>
    </div>
</div>