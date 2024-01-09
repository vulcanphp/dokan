<?php

use App\Core\Payments\Payments;
?>
<section x-cloak x-show="tab == 'payment-form'">
    <div class="text-center w-full sm:w-10/12 md:w-8/12 mx-auto">
        <h2 class="font-semibold text-2xl mb-4"><?= translate('Add/Edit Payment') ?></h2>
        <form method="post" enctype="multipart/form-data">
            <?= csrf() ?>
            <input type="hidden" name="action" value="payment">
            <input type="hidden" name="id" x-model="payment.id">
            <input type="number" name="order_id" x-model="payment.order_id" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Invoice ID') ?>">
            <div class="flex">
                <div class="w-6/12 pr-2">
                    <input type="number" step="any" name="subtotal" x-model="payment.subtotal" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Subtotal') ?>">
                </div>
                <div class="w-6/12 pl-2">
                    <input type="number" step="any" name="total" x-model="payment.total" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Total') ?>">
                </div>
            </div>
            <input type="text" name="payment_id" x-model="payment.payment_id" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Payment ID') ?>">
            <select name="method" x-model="payment.method" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach (collect(Payments::$instance->getPayments())->mapWithKeys(fn ($m) => [$m->getId() => $m->getTitle()])->all() as $id => $title) : ?>
                    <option value="<?= $id ?>"><?= $title ?></option>
                <?php endforeach ?>
            </select>
            <select name="status" x-model="payment.status" required class="mb-4 w-full px-4 py-2 outline-none text-center focus:outline-xamber-700 rounded-full bg-xbg-700">
                <?php foreach (['pending', 'due', 'unpaid', 'paid', 'refund'] as $id) : ?>
                    <option value="<?= $id ?>"><?= ucfirst($id) ?></option>
                <?php endforeach ?>
            </select>
            <button class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 inline-block mt-2 rounded-full"><?= translate('Save') ?></button>
        </form>
    </div>
</section>