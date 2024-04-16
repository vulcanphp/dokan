<?php

namespace App\Core\Payments;

use Exception;

class Payments
{
    public static Payments $instance;

    protected array $processors;

    public function __construct(array $processors = [])
    {
        self::$instance = $this;

        foreach ($processors as $processor) {
            $this->addPayment($processor);
        }
    }

    public static function create(...$args): Payments
    {
        return new Payments(...$args);
    }

    public function addPayment(Processor $processor): self
    {
        if ($processor->isSupported()) {
            $this->processors[] = $processor;
        }

        return $this;
    }

    public function hasPayments(): bool
    {
        return isset($this->processors) && !empty($this->processors);
    }

    public function getPayments(): array
    {
        return $this->processors ?? [];
    }

    public function getPayment(string $id): Processor
    {
        foreach ($this->processors as $processor) {
            if ($processor->getId() == $id) {
                return $processor;
            }
        }

        throw new Exception('Undefined Payment Processor: ' . $id);
    }

    public function getDefaultPayment(): Processor
    {
        return $this->processors[0];
    }
}
