<?php

use App\Core\Currency;
?>
<a fire @click="isOpen = false" href="<?= $product->getSlug() ?>" class="flex px-1 py-1 group-hover:opacity-80 hover:opacity-[1!important] transition ease-in-out duration-100 <?= !$first ? 'border-t border-xbg-600 pt-3 mt-2' : '' ?>">
    <div class="w-3/12">
        <img src="<?= storage_url($product->imageSize(200, 200)) ?>" alt="<?= $product->title ?><" class="w-full rounded">
    </div>
    <div class="w-9/12 pl-3">
        <p><?= $product->title ?></p>
        <p><?= Currency::$instance->format($product->price, 'text-base') ?></p>
    </div>
</a>