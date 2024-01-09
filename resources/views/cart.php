<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Cart - ' . Configurator::$instance->get('title', 'Dokan'),
    ])
    ->include('includes.cart.config')
?>

<template x-if="cart.length > 0">
    <div>
        <?php $this->include('includes.cart.table') ?>
        <div class="flex justify-center md:justify-end mt-6">
            <div class="w-10/12 md:w-8/12 lg:w-5/12">
                <?php $this->include('includes.cart.calculator') ?>
                <div class="text-center">
                    <a href="<?= home_url('checkout') ?>" class="bg-xamber-700 hover:bg-xamber-800 px-8 py-3 md:px-10 md:py-4 mt-6 rounded-full font-semibold text-xl md:text-2xl inline-block"><?= translate('Checkout') ?></a>
                </div>
            </div>
        </div>
    </div>
</template>
<template x-if="cart.length == 0">
    <?php $this->include('includes.cart.empty') ?>
</template>

<!-- @cart end section config -->
</section>