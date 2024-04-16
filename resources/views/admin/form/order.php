<section x-cloak x-show="tab == 'order-form'">
    <div class="text-center w-full sm:w-10/12 md:w-8/12 mx-auto">
        <h2 class="font-semibold text-2xl mb-4"><?= translate('Add/Edit Order') ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?= csrf() ?>
            <input type="hidden" name="action" value="order">
            <input type="hidden" name="id" x-model="order.id">
            <input type="text" name="name" x-model="order.name" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Order Name') ?>">
            <input type="email" name="email" x-model="order.email" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Order Email') ?>">
            <input type="number" name="phone" x-model="order.phone" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Order Phone') ?>">
            <textarea name="address" x-model="order.address" class="mb-4 w-full px-4 py-2 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="Order Address"></textarea>
            <select name="status" x-model="order.status" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach (['pending', 'processing', 'shipped', 'delivered', 'canceled'] as $id) : ?>
                    <option value="<?= $id ?>"><?= ucfirst($id) ?></option>
                <?php endforeach ?>
            </select>
            <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-2 rounded-full"><?= translate('Save') ?></button>
        </form>
    </div>
</section>