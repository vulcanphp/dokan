<?php

namespace App\Core;

class Currency
{
    public static Currency $instance;

    protected array $currencies;

    public function __construct(protected string $filepath, protected string $currency)
    {
        self::$instance = $this;

        $this->currencies = json_decode(
            file_get_contents($filepath),
            true
        );
    }

    public static function create(...$args): Currency
    {
        return new Currency(...$args);
    }

    public function getList(): array
    {
        return $this->currencies;
    }

    public function getCurrency(): array
    {
        return $this->getList()[$this->currency];
    }

    public function format(float $value, string $class = 'text-xl'): string
    {
        $currency = $this->getCurrency();

        return '<bdi class="font-semibold text-xamber-700 ' . $class . '"><span class="mr-1">'
            . $currency['symbol_native']
            . '</span>'
            . number_format($value, $currency['decimal'])
            . '</bdi>';
    }
}
