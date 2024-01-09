<section x-cloak x-show="tab == 'order'">
    <div class="flex items-center justify-between mb-4">
        <button @click="newOrder()" class="bg-xamber-700 hover:bg-xamber-800 px-4 py-1 rounded"><?= translate('+ New') ?></button>
        <form x-ref="orderSearch">
            <input type="search" name="search-order" value="<?= input('search-order') ?>" @input.debounce.800ms="$refs.orderSearch.submit();" class="px-4 py-[6px] bg-xbg-700 text-center rounded-full outline-none focus:outline-xamber-700" placeholder="<?= translate('Order Email/Phone/ID') ?>">
        </form>
    </div>
    <table class="w-full">
        <thead class="bg-xbg-600">
            <tr>
                <th class="px-4 py-2 text-left rounded-tl"><?= translate('Invoice') ?></th>
                <th class="px-4 py-2 text-left"><?= translate('Customer') ?></th>
                <th class="px-4 py-2 text-left hidden md:table-cell"><?= translate('Status') ?></th>
                <th class="px-4 py-2 text-left hidden md:table-cell"><?= translate('Date') ?></th>
                <th class="px-4 py-2 text-left rounded-tr"><?= translate('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php

            use VulcanPhp\Core\Helpers\Time;

            if (!$order->hasData()) : ?>
                <tr>
                    <td class="text-center px-4 py-2 text-gray-300 bg-xbg-700 rounded-b" colspan="5"><?= translate('Order Table is Empty') ?></td>
                </tr>
            <?php endif ?>
            <?php foreach ($order->getData() as $key => $item) : ?>
                <?php $last = count($order->getData()) == $key + 1 ?>
                <tr class="bg-xbg-700">
                    <td class="px-4 py-2 text-left <?= $last ? 'rounded-bl' : '' ?>">
                        <a class="bg-xamber-700 hover:bg-xamber-800 px-2 rounded-full text-sm" href="<?= url('invoice', ['id' => base64_encode($item->id)]) ?>">#<?= $item->id ?></a>
                    </td>
                    <td class="px-4 py-2 text-sm">
                        <p class="uppercase text-xamber-700 font-semibold"><?= $item->name ?></p>
                        <p><?= $item->email ?>, <?= $item->phone ?></p>
                    </td>
                    <td class="px-4 py-2 hidden md:table-cell capitalize text-sm"><?= $item->status ?></td>
                    <td class="px-4 py-2 hidden md:table-cell text-sm"><?= Time::dateFormat($item->ordered_at) ?></td>
                    <td class="px-4 py-2 <?= $last ? 'rounded-br' : '' ?>">
                        <button @click='editOrder(<?= json_encode($item->toArray()) ?>)' class="text-xs sm:text-sm px-2 rounded inline-block bg-yellow-600 hover:bg-yellow-700 ml-1"><?= translate('Edit') ?></button>
                        <a onclick="return confirm('Are you sure to delete this')" href="?action=delete-order&id=<?= $item->id ?>" class="text-xs sm:text-sm px-2 rounded inline-block bg-rose-600 hover:bg-rose-700 ml-1"><?= translate('Delete') ?></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php if ($order->hasLinks()) : ?>
        <div class="flex justify-center mt-4">
            <?= $order->getLinks(1) ?>
        </div>
    <?php endif ?>
</section>