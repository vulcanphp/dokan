<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Checkout - ' . Configurator::$instance->get('title', 'Dokan'),
    ])
    ->include('includes.cart.config')
?>

<template x-if="cart.length > 0">
    <div class="flex flex-row justify-center md:justify-start flex-wrap my-8">
        <div class="w-10/12 md:w-5/12">
            <?php $this->include('includes.checkout.order') ?>
        </div>
        <div class="md:w-7/12 mt-8 md:mt-0 md:pl-8">
            <?php $this->include('includes.checkout.billing') ?>
        </div>
    </div>
</template>

<template x-if="cart.length == 0">
    <?php $this->include('includes.cart.empty') ?>
</template>

<!-- @cart end section config -->
</section>