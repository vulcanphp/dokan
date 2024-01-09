<?php

namespace App\Core\Payments\Processor;

use App\Core\Configurator;
use App\Core\Currency;
use App\Core\Payments\Processor;
use Exception;
use VulcanPhp\EasyCurl\EasyCurl;
use VulcanPhp\EasyCurl\EasyCurlResponse;

class PayPal extends Processor
{
    protected const API_ENDPOINT = [
        'sandbox'    => 'https://api.sandbox.paypal.com/v1/',
        'production' => 'https://api.paypal.com/v1/',
    ];

    public function __construct()
    {
        $this->config = [
            'env'           => Configurator::$instance->get('paypal_environment'),
            'client_id'     => Configurator::$instance->get('paypal_client_id'),
            'client_secret' => Configurator::$instance->get('paypal_client_secret'),
        ];

        $this->setup = [
            'id'            => 'paypal',
            'title'         => 'PayPal',
            'description'   => 'Pay Via Your PayPal Balance.',
        ];
    }

    public function isSupported(): bool
    {
        return Configurator::$instance->is('paypal_enabled')
            && Configurator::$instance->has('paypal_environment')
            && Configurator::$instance->has('paypal_client_id')
            && Configurator::$instance->has('paypal_client_secret')
            && in_array(Currency::$instance->getCurrency()['code'], ['AUD', 'BRL', 'CAD', 'CNY', 'CZK', 'DKK', 'EUR', 'HKD', 'HUF', 'ILS', 'JPY', 'MYR', 'MXN', 'TWD', 'NZD', 'NOK', 'PHP', 'PLN', 'GBP', 'SGD', 'SEK', 'CHF', 'THB', 'USD']);
    }

    public function validate($amount, array $resource): array
    {
        if (isset($resource['paymentID']) && !empty($resource['paymentID'])) {
            $payment = $this->getPaymentInfo($resource['paymentID']);

            // detect Error
            if (!isset($payment['transactions']) && isset($payment['debug_id']) && isset($payment['message'])) {
                throw new Exception('PayPal Error: ' . $payment['message']);
            }

            return [
                'id'        => $resource['paymentID'],
                'status'    => (isset($payment) && is_array($payment) && !empty($payment)
                    && isset($payment['state']) && isset($payment['transactions'])
                    && $payment['state'] == 'approved'
                    && strtolower(Currency::$instance->getCurrency()['code']) == strtolower($payment['transactions'][0]['amount']['currency'])
                    && $payment['transactions'][0]['amount']['details']['subtotal'] >= $amount) ? 'paid' : 'unpaid'
            ];
        }

        return ['id' => 'N/A', 'status' => 'due'];
    }

    protected function getAccessToken()
    {
        $cache = cache('payments')->eraseExpired();

        if ($cache->hasCache('paypal_access_token')) {
            return $cache->retrieve('paypal_access_token');
        }

        $auth = $this->sendRequest([
            'action'    => 'oauth2/token',
            'fields'    => ['grant_type' => 'client_credentials'],
        ])->getJson();

        if (!isset($auth['access_token'])) {
            throw new Exception('Failed to get PayPal Access Token');
        }

        $cache->store('paypal_access_token', $auth['access_token'], (round(($auth['expires_in'] / 60) / 60) - 1) . ' minutes');

        return $auth['access_token'];
    }

    protected function getPaymentInfo($payment_id)
    {
        return $this->sendRequest([
            'action'  => 'payments/payment/' . $payment_id,
            'headers' => [
                'Authorization: Bearer ' . $this->getAccessToken(),
                'Content-Type: application/json',
            ],
        ])->getJson();
    }

    protected function sendRequest(array $args): EasyCurlResponse
    {
        $http = EasyCurl::setOption(
            CURLOPT_USERPWD,
            $this->getConfig('client_id') . ':' . $this->getConfig('client_secret')
        )
            ->setHeaders($args['headers'] ?? []);

        if (isset($args['fields'])) {
            $http->setPostFields($args['fields']);
        }

        return $http->send(
            self::API_ENDPOINT[$this->getConfig('env')] . $args['action'],
            $args['params'] ?? []
        );
    }
}
