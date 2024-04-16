<?php

use App\Core\Configurator;
use App\Core\Currency;
use App\Core\Payments\Payments;
use VulcanPhp\Core\Helpers\Time;

$this
    ->layout('includes.invoice.layout')
    ->block('title', 'Invoice ID #' . $invoice->getOrder('id') . ' - ' . Configurator::$instance->get('title', 'Dokan'))
?>

<div class="flex justify-center sm:justify-between items-center py-4">
    <div class="flex items-center text-xamber-700 pl-4 print:pl-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24">
            <path fill="currentColor" d="M19 2H5C3.346 2 2 3.346 2 5v2.831c0 1.053.382 2.01 1 2.746V20a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-5h4v5a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-9.424c.618-.735 1-1.692 1-2.746V5c0-1.654-1.346-3-3-3zm1 3v2.831c0 1.14-.849 2.112-1.891 2.167L18 10c-1.103 0-2-.897-2-2V4h3c.552 0 1 .449 1 1zM10 8V4h4v4c0 1.103-.897 2-2 2s-2-.897-2-2zM4 5c0-.551.448-1 1-1h3v4c0 1.103-.897 2-2 2l-.109-.003C4.849 9.943 4 8.971 4 7.831V5zm6 11H6v-3h4v3z"></path>
        </svg>
        <span class="font-semibold text-2xl ml-2"><?= Configurator::$instance->get('title', 'Dokan') ?></span>
    </div>
    <span class="hidden sm:block uppercase text-3xl text-white print:text-gray-200 print:bg-white font-bold bg-xamber-700 py-1 pr-10 pl-4 print:pr-0"><?= translate('Invoice') ?></span>
</div>
<div class="px-4 pb-4 print:px-0">
    <div class="flex items-start justify-between">
        <div>
            <p class="font-semibold"><?= translate('Invoice ID') ?> #<?= $invoice->getOrder('id') ?></p>
            <p class="text-sm text-gray-700"><?= translate('Date') ?>: <?= Time::dateFormat($invoice->getOrder('ordered_at')) ?></p>
        </div>
        <div>
            <p class="font-semibold"><?= translate('Payment') ?></p>
            <p class="text-sm text-gray-700"><?= Payments::$instance->getPayment($invoice->getOrder('method'))->getTitle() ?></p>
            <p class="text-sm text-gray-700"><?= translate('Status') ?>: <span class="uppercase font-bold <?= ['paid' => 'text-green-600', 'due' => 'text-rose-500'][$status = $invoice->getOrder('payment_status')] ?? 'text-gray-500' ?>"><?= translate($status) ?></span></p>
        </div>
    </div>
</div>
<div class="border-t-2 border-xamber-700 flex flex-row flex-wrap justify-between px-4 py-4 print:px-0">
    <div class="w-full sm:w-5/12">
        <p class="font-semibold mb-1"><?= translate('Customer') ?></p>
        <p class="text-gray-700 uppercase"><?= $invoice->getOrder('name') ?></p>
        <p class="text-sm text-gray-700"><?= $invoice->getOrder('email') ?>, <?= $invoice->getOrder('phone') ?></p>
    </div>
    <div class="hidden sm:block w-1/12"></div>
    <div class="w-full sm:w-6/12 mt-4 sm:mt-0">
        <p class="font-semibold mb-1"><?= translate('Address') ?></p>
        <p class="text-sm text-gray-700"><?= $invoice->getOrder('address') ?></p>
    </div>
</div>
<table class="w-full">
    <thead class="border-t-2 border-b-2 border-xamber-700">
        <tr>
            <th class="px-4 print:px-0 py-2 font-semibold text-left"><?= translate('Item') ?></th>
            <th class="px-4 print:px-0 py-2 font-semibold text-left hidden sm:table-cell"><?= translate('Price') ?></th>
            <th class="px-4 print:px-0 py-2 font-semibold text-left hidden sm:table-cell"><?= translate('Quantity') ?></th>
            <th class="px-4 print:px-0 py-2 font-semibold text-left"><?= translate('Total') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invoice->getOrder('products') as $product) : ?>
            <tr>
                <td class="text-sm text-gray-700 px-4 print:px-0 py-2 border-b"><?= $product['title'] ?></td>
                <td class="text-sm text-gray-700 px-4 print:px-0 hidden sm:table-cell py-2 border-b"><?= Currency::$instance->format($product['price'], 'text-sm') ?></td>
                <td class="text-sm text-gray-700 px-4 print:px-0 hidden sm:table-cell py-2 border-b"><?= $product['quantity'] ?></td>
                <td class="text-sm text-gray-700 px-4 print:px-0 py-2 border-b"><?= Currency::$instance->format($product['price'] * $product['quantity'], 'text-sm') ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="flex justify-end py-4">
    <table class="w-10/12 sm:w-6/12 lg:w-5/12">
        <tr>
            <th class="p-1 font-semibold text-right"><?= translate('Subtotal') ?></th>
            <td class="p-1">
                <p class="ml-2 text-gray-700"><?= Currency::$instance->format($invoice->getOrder('subtotal'), 'text-sm') ?></p>
            </td>
        </tr>
        <?php if (Configurator::$instance->has('shipping')) : ?>
            <tr>
                <th class="p-1 font-semibold text-right"><?= translate('Shipping') ?></th>
                <td class="p-1">
                    <p class="ml-2 text-gray-700"><?= Currency::$instance->format(Configurator::$instance->get('shipping'), 'text-sm') ?></p>
                </td>
            </tr>
        <?php endif ?>
        <?php if (Configurator::$instance->has('vat')) : ?>
            <tr>
                <th class="p-1 font-semibold text-right"><?= translate('VAT') ?></th>
                <td class="p-1">
                    <p class="ml-2 text-gray-700"><?= Currency::$instance->format($invoice->getVatTotal(), 'text-sm') ?> (<?= Configurator::$instance->get('vat') ?>%)</p>
                </td>
            </tr>
        <?php endif ?>
        <tr class="border-t-2 border-xamber-700">
            <th class="p-1 font-bold text-right"><?= translate('Total') ?></th>
            <td class="p-1">
                <p class="ml-2 text-gray-700"><?= Currency::$instance->format($invoice->getOrder('total'), 'text-sm') ?></p>
            </td>
        </tr>
    </table>
</div>