<?php $this->include('includes.checkout.config') ?>

<h2 class="text-2xl text-center md:text-left font-semibold mb-6"><?= translate('Customer Details') ?></h2>
<form action="<?= url('order') ?>" method="post" @submit.prevent="submitForm()" x-ref="billingForm">
    <?= csrf() ?>
    <input type="hidden" name="products" :value="getOrderedProducts()">
    <input type="text" name="name" :value="billing.name" required class="mb-5 w-full px-6 py-3 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Name')?>">
    <input type="email" name="email" :value="billing.email" required class="mb-5 w-full px-6 py-3 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Email Address')?>">
    <input type="number" name="phone" :value="billing.phone" required class="mb-5 w-full px-6 py-3 outline-none focus:outline-xamber-700 rounded-full bg-xbg-700" placeholder="<?= translate('Phone Number')?>">
    <textarea name="address" required :value="billing.address" class="mb-5 w-full px-6 py-3 outline-none focus:outline-xamber-700 rounded-3xl bg-xbg-700" placeholder="<?= translate('Address')?>"></textarea>
    <?php $this->include('includes.checkout.payment') ?>
</form>

<!-- @end of checkout billing config -->
</div>