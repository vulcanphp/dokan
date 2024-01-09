<?php

use App\Core\Currency;
use VulcanPhp\Core\Helpers\Time;

?>
<tr class="border-t border-xbg-600">
    <td class="px-2 py-1 md:px-4 md:py-3">
        <div class="flex items-center">
            <img src="<?= storage_url($order->imageSize(200, 200)) ?>" class="hidden md:block w-16 h-16 rounded shadow" alt="<?= $order->title ?>">
            <div class="md:ml-3">
                <a class="text-sm md:text-base" href="<?= $order->getSlug() ?>"><?= $order->title ?></a>
                <p class="mt-1 text-sm text-xamber-700 font-semibold"><?= Currency::$instance->format($order->price, 'text-sm') ?> (x<?= $order->quantity ?>)</p>
            </div>
        </div>
    </td>
    <td class="px-2 py-1 md:px-4 md:py-3 text-center">
        <p class="text-sm capitalize font-semibold <?= ['completed' => 'text-green-600', 'canceled' => 'text-rose-500', 'waiting' => 'text-xamber-800'][$order->status] ?? 'text-yellow-400' ?>"><?= $order->status ?></p>
    </td>
    <td class="px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell text-center">
        <p class="text-sm md:text-base"><?= Time::dateFormat($order->ordered_at) ?></p>
    </td>
    <td class="px-2 py-1 md:px-4 md:py-3 text-center">
        <a href="<?= url('invoice', ['id' => base64_encode($order->order_id)]) ?>" class="text-xs md:text-sm bg-xamber-700 hover:bg-xamber-800 px-2 py-1 rounded-full"><?= translate('Invoice') ?>&nbsp;#<?= $order->order_id ?></a>
    </td>
</tr>