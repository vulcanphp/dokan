<?php

use App\Core\Currency;
?>
<a href="<?= $product->getSlug() ?>" class="mt-4 bg-xbg-700 hover:bg-xbg-600 p-4 md:p-2 rounded-md transition ease-in-out duration-150 flex">
    <div class="w-4/12">
        <img src="<?= storage_url($product->imageSize(200, 200)) ?>" alt="<?= $product->title ?><" class="w-full rounded">
    </div>
    <div class="w-8/12 pl-4 md:pl-2">
        <p class="md:text-sm"><?= $product->title ?></p>
        <p><?= Currency::$instance->format($product->price, 'text-lg') ?></p>
    </div>
</a>