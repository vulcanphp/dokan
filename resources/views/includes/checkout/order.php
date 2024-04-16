<h2 class="text-2xl text-center md:text-left font-semibold mb-6"><?= translate('Your Order') ?></h2>
<?php $this->include('includes.cart.summary') ?>
<?php $this->include('includes.cart.calculator') ?>
<div class="text-center mt-4">
    <a fire href="<?= url('cart') ?>" class="px-4 py-1 text-sm rounded-full bg-xamber-700 hover:bg-xamber-800"><?= translate('View Cart') ?></a>
</div>