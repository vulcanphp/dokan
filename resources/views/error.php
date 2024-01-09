<?php

use App\Core\Configurator;

if (empty(input('info'))) {
    abort(404);
}

$error = decode_string(base64_decode(input('info')));

if (!is_array($error)) {
    abort(404);
}

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Order Failed - ' . Configurator::$instance->get('title', 'Dokan'),
    ])
?>

<div class="mx-auto w-10/12 md:w-8/12 lg:w-6/12 bg-rose-100 text-rose-600 rounded-2xl px-6 py-4 text-center my-8">
    <h2 class="font-bold text-3xl text-rose-700 mb-2"><?= translate('Order Failed') ?></h2>
    <p class="mb-2 font-semibold"><?= $error['message'] ?></p>
    <p class="mb-2"><?= translate('Error Code:') ?> <b><?= $error['code'] ?></b></p>
    <p class="italic font-semibold"><?= translate('Contact us to get help') ?></p>
</div>