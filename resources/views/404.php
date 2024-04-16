<?php

use App\Core\Configurator;

$this
    ->layout('layout.master')
    ->setupMeta([
        'title' => 'Page Not Found - ' . Configurator::$instance->get('title', 'Dokan'),
    ])
    ->include('includes.cart.config')
?>
<div class="mx-auto w-10/12 sm:w-8/12 md:w-6/12 lg:w-5/12 text-center my-10">
    <h2 class="text-xamber-700 text-6xl font-semibold mb-4">404</h2>
    <p class="text-xl text-gray-300 mb-4"><?= translate('Sorry, the page you are looking for does not exists.') ?></p>
    <a fire href="<?= home_url() ?>" class="text-xamber-700"><?= translate('← Home') ?></a>
</div>