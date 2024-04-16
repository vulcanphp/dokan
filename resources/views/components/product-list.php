<?php

use App\Core\Currency;
?>
<a fire href="<?= $product->getSlug() ?>" class="mt-4 flex">
    <div class="w-4/12 md:pr-3">
        <img src="<?= storage_url($product->imageSize(200, 200)) ?>" alt="<?= $product->title ?><" class="w-full rounded">
    </div>
    <div class="w-8/12">
        <p class="md:text-sm"><?= $product->title ?></p>
        <p><?= Currency::$instance->format($product->price, 'text-base') ?></p>
    </div>
</a>