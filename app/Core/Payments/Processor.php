<?php

namespace App\Core\Payments;

abstract class Processor
{
    protected array $setup, $config;

    /**
     * 
     * @param float|int $amount 
     * @param array $resource
     * @return array [status, id]
     */
    abstract public function validate($amount, array $resource): array;

    abstract public function isSupported(): bool;

    public function getId(): string
    {
        return $this->setup['id'];
    }

    public function getTitle(): string
    {
        return $this->setup['title'];
    }

    public function getDescription(): string
    {
        return $this->setup['description'];
    }

    public function getConfig(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }

    public function getView(): string
    {
        ob_start();

        include resource_dir('views/includes/checkout/payments/' . $this->getId() . '.php');

        return ob_get_clean();
    }
}
