<?php if (!$orders->isEmpty()) : ?>
    <div class="bg-xbg-700 mt-8 border border-xbg-600 rounded-xl">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="border-r border-xbg-600 px-2 py-1 md:px-4 md:py-3"><?= translate('Product') ?></th>
                    <th class="border-r border-xbg-600 px-2 py-1 md:px-4 md:py-3"><?= translate('Status') ?></th>
                    <th class="border-r border-xbg-600 px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell"><?= translate('Date') ?></th>
                    <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Invoice') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $orderData = [];
                foreach ($orders->all() as $order) {
                    $orderData[$order->order_id][] = $order;
                }
                ?>
                <?php foreach ($orderData as $order) : ?>
                    <?php $this->include('ajax.parts.order', ['order' => $order]) ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="text-center mt-8">
        <h2 class="text-2xl text-gray-400"><?= translate('Products Unavailable') ?></h2>
    </div>
<?php endif ?>