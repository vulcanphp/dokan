<?php

namespace App\Core\Payments\Processor;

use App\Core\Configurator;
use App\Core\Payments\Processor;

class CashOnDelivery extends Processor
{
    public function __construct()
    {
        $this->setup = [
            'id' => 'cod',
            'title' => 'Cash On Delivery',
            'description' => 'Order Now, Pay Later when you get the delivery.',
        ];
    }

    public function isSupported(): bool
    {
        return Configurator::$instance->is('cod_enabled');
    }

    public function validate($amount, array $resource): array
    {
        return ['status' => 'due'];
    }
}
