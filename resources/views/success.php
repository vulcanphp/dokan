<?php

use App\Core\Configurator;

if (empty(input('order'))) {
    abort(404);
}

$id = base64_decode(input('order'));

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Order Success - ' . Configurator::$instance->get('title', 'Dokan'),
    ]);
?>

<div x-init="cart = []" class="mx-auto w-10/12 md:w-8/12 lg:w-6/12 bg-green-100 text-green-600 rounded-2xl px-6 py-4 text-center my-8">
    <h2 class="font-bold text-3xl text-green-700 mb-2"><?= translate('Order Placed') ?></h2>
    <p class="mb-2"><?= translate('Your order has been placed successfully.') ?></p>
    <a class="text-xamber-700 hover:text-xamber-800 font-semibold text-lg" href="<?= url('invoice', ['id' => base64_encode($id)]) ?>"><?= translate('Invoice') ?> #<?= $id ?></a>
</div>

<div class="text-center mb-4">
    <a href="<?= home_url() ?>" class="bg-xamber-700 hover:bg-xamber-800 px-4 py-2 md:px-6 md:py-3 rounded-full font-semibold text-lg md:text-xl inline-block"><?= translate('Continue Shopping') ?></a>
</div>