<?php

use VulcanPhp\Core\Helpers\Arr;

$productArray = Arr::only($product->toArray(), ['id', 'title', 'price', 'quantity']);
$productArray['image'] = $product->imageSize(200, 200);

?>
<div class="<?= $class['parent'] ?? '' ?> mt-4">
    <?php if ($product->quantity >= 1) : ?>
        <?php if ($customize) : ?>
            <input type="number" x-ref="cartCustomize<?= $product->id ?>" :readonly="hasCart(<?= $product->id ?>)" :value="getQuantity(<?= $product->id ?>)" min="1" max="<?= $product->quantity ?>" class="bg-xbg-600 rounded-l-full outline-none px-4 py-2">
        <?php endif ?>
        <template x-if="hasCart(<?= $product->id ?>)">
            <button @click='removeCart(<?= $product->id ?>)' class="bg-rose-500 hover:bg-rose-600 transition ease-in-out duration-150 px-2 py-1 rounded-full flex items-center <?= $class['button'] ?? '' ?>">
                <span><?= translate('Remove') ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current <?= $class['icon'] ?? '' ?>" viewBox="0 0 24 24">
                    <path d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z"></path>
                    <circle cx="10.5" cy="19.5" r="1.5"></circle>
                    <circle cx="16.5" cy="19.5" r="1.5"></circle>
                </svg>
            </button>
        </template>
        <template x-if="!hasCart(<?= $product->id ?>)">
            <button @click='addCart(<?= json_encode($productArray) ?><?= $customize ? ', $refs.cartCustomize' . $product->id . '.value' : '' ?>)' class="bg-xamber-700 hover:bg-xamber-800 transition ease-in-out duration-150 px-3 py-1 rounded-full flex items-center <?= $class['button'] ?? '' ?>">
                <span><?= translate('Add To') ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current <?= $class['icon'] ?? '' ?>" viewBox="0 0 24 24">
                    <path d="M21 4H2v2h2.3l3.521 9.683A2.004 2.004 0 0 0 9.7 17H18v-2H9.7l-.728-2H18c.4 0 .762-.238.919-.606l3-7A.998.998 0 0 0 21 4z"></path>
                    <circle cx="10.5" cy="19.5" r="1.5"></circle>
                    <circle cx="16.5" cy="19.5" r="1.5"></circle>
                </svg>
            </button>
        </template>
    <?php else : ?>
        <p class="text-red-400 font-semibold"><?= translate('Out of Stock') ?></p>
    <?php endif ?>
</div>