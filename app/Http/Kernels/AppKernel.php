<?php

namespace App\Http\Kernels;

use App\Core\Configurator;
use App\Core\Currency;
use App\Core\Payments\Payments;
use App\Core\Payments\Processor\CashOnDelivery;
use App\Core\Payments\Processor\PayPal;
use App\Core\Payments\Processor\Stripe;
use VulcanPhp\Core\Foundation\Interfaces\IKernel;
use VulcanPhp\Translator\Manager\TranslatorFileManager;
use VulcanPhp\Translator\Translator;

class AppKernel implements IKernel
{
    public function boot(): void
    {
        // CoPlay App Configurator
        $config = Configurator::configure();

        // configure CoPlay
        if (!$config->isConfigured() && url()->getPath() != '/admin/') {
            redirect('admin');
        }

        // set language manager
        Translator::$instance->getDriver()
            ->setManager(new TranslatorFileManager([
                'convert'   => $config->get('language', config('app.language')),
                'local_dir' => config('app.language_dir'),
            ]));

        // initialize currency
        Currency::create(storage_dir('currency.json'), $config->get('currency', 'USD'));

        // setup Payments
        Payments::create([
            new CashOnDelivery(),
            new Stripe(),
            new PayPal()
        ]);
    }

    public function shutdown(): void
    {
    }
}
