<?php if (!$orders->isEmpty()) : ?>
    <table class="bg-xbg-700 w-full mt-8 px-4 py-2 rounded-xl">
        <thead>
            <tr>
                <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Product') ?></th>
                <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Status') ?></th>
                <th class="px-2 py-1 md:px-4 md:py-3 hidden sm:table-cell"><?= translate('Date') ?></th>
                <th class="px-2 py-1 md:px-4 md:py-3"><?= translate('Invoice') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders->all() as $order) : ?>
                <?php $this->include('ajax.parts.order', ['order' => $order]) ?>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="text-center mt-8">
        <h2 class="text-2xl text-gray-400"><?= translate('Products Unavailable') ?></h2>
    </div>
<?php endif ?>