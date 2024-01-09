<?php

namespace App\Core\Payments\Processor;

use App\Core\Configurator;
use App\Core\Currency;
use App\Core\Payments\Processor;
use Exception;
use VulcanPhp\EasyCurl\EasyCurl;

class Stripe extends Processor
{
    protected const ENDPOINT = 'https://api.stripe.com/v1';

    public function __construct()
    {
        $this->config = [
            'publishable_key'   => Configurator::$instance->get('stripe_publishable_key'),
            'secret_key'        => Configurator::$instance->get('stripe_secret_key'),
        ];

        $this->setup = [
            'id'            => 'stripe',
            'title'         => 'Stripe',
            'description'   => 'Pay With Cards Via Stripe Card Payment Processing.',
        ];
    }

    public function isSupported(): bool
    {
        return Configurator::$instance->is('stripe_enabled')
            && Configurator::$instance->has('stripe_publishable_key')
            && Configurator::$instance->has('stripe_secret_key');
    }

    public function validate($amount, array $resource): array
    {
        if (isset($resource['token']['id']) && isset($resource['token']['used']) && !$resource['token']['used']) {
            // charge stripe from token
            $amount     = $this->chargeAmount($amount);
            $currency   = strtolower(Currency::$instance->getCurrency()['code']);
            $result     = EasyCurl::setHeader(
                'Authorization',
                'Bearer ' . $this->getConfig('secret_key')
            )
                ->setPostFields([
                    "amount"    => $amount,
                    "currency"  => $currency,
                    "source"    => $resource['token']['id'],
                ])
                ->send(self::ENDPOINT . '/charges')
                ->getJson();

            // check for error
            if (isset($result['error']) && !empty($result['error']['message'] ?? '')) {
                throw new Exception('Stripe Error: ' . $result['error']['message']);
            }

            // validate charged result..
            if (
                isset($result['id']) && isset($result['paid']) && isset($result['captured'])
                && $result['paid'] && $result['captured'] && ($result['amount_captured'] ?? 0) >= $amount
                && strtolower($result['currency'] ?? '') == $currency
            ) {
                return ['id' => $result['id'], 'status' => 'paid'];
            }
        }

        return ['id' => 'N/A', 'status' => 'due'];
    }

    protected function chargeAmount($amount)
    {
        // @see https://stripe.com/docs/currencies
        $currency = Currency::$instance->getCurrency();

        // currency for two digit decimal
        if ($currency['decimal'] == 2) {
            return ceil($amount * 100);
        } elseif ($currency['decimal'] == 3) {
            $amount = ceil($amount * 1000);
            // @see https://stripe.com/docs/currencies#three-decimal
            if (substr($amount, -1) != 0) {
                $amount = substr($amount, 0, strlen($amount) - 1) . substr($amount, -2, 1) + 1 . '0';
            }
            return intval($amount);
        } elseif ($currency['decimal'] == 0) {
            return ceil($amount);
        } else {
            throw new Exception('Unsupported Stripe Currency To charge');
        }
    }
}
