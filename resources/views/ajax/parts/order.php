<?php

use App\Core\Currency;
use VulcanPhp\Core\Helpers\Time;

?>
<tr class="border-t border-xbg-600">
    <td class="border-r border-xbg-600">
        <?php foreach ($order as $index => $item) : ?>
            <div class="flex items-center px-2 py-1 md:px-4 md:py-3 <?= $index != 0 ? 'border-t border-xbg-600' : '' ?>">
                <a fire href="<?= $item->getSlug() ?>">
                    <img src="<?= storage_url($item->imageSize(200, 200)) ?>" class="hidden md:block w-16 h-16 rounded shadow" alt="<?= $item->title ?>">
                </a>
                <div class="md:ml-3">
                    <a fire class="text-sm md:text-base" href="<?= $item->getSlug() ?>"><?= $item->title ?></a>
                    <p class="mt-1 text-sm text-xamber-700 font-semibold"><?= Currency::$instance->format($item->price, 'text-sm') ?> (x<?= $item->quantity ?>)</p>
                </div>
            </div>
        <?php endforeach ?>
    </td>
    <td class="border-r border-xbg-600 px-2 py-1 md:px-4 md:py-3 text-center">
        <p class="text-sm capitalize font-semibold <?= ['delivered' => 'text-green-600', 'canceled' => 'text-rose-500', 'pending' => 'text-xamber-800'][$order[0]->status] ?? 'text-yellow-400' ?>"><?= $order[0]->status ?></p>
    </td>
    <td class="border-r border-xbg-600 px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell text-center">
        <p class="text-sm md:text-base"><?= Time::dateFormat($order[0]->ordered_at) ?></p>
    </td>
    <td class="px-2 py-1 md:px-4 md:py-3 text-center">
        <a href="<?= url('invoice', ['id' => base64_encode($order[0]->order_id)]) ?>" class="text-xs md:text-sm bg-xamber-700 hover:bg-xamber-800 px-2 py-1 rounded-full"><?= translate('Invoice') ?>&nbsp;#<?= $order[0]->order_id ?></a>
    </td>
</tr>