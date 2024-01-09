<?php

namespace App\Core;

use App\Models\Option;
use Exception;

class Configurator
{
    public static Configurator $instance;
    protected array $data = [];
    protected bool $isChanged = false, $isConfigured = true;

    public function __construct()
    {
        self::$instance = $this;

        try {
            $this->data = Option::Cache()
                ->load(
                    'loaded',
                    fn () => Option::get()
                        ->mapWithKeys(fn ($option) => [$option->name => decode_string($option->value)])
                        ->all()
                );
        } catch (Exception $e) {
            if ($e->getCode() == 'HY000') {
                $this->isConfigured = false;
            } else {
                throw $e;
            }
        }

        if (empty($this->data)) {
            $this->isConfigured = false;
        }
    }

    public static function configure(): Configurator
    {
        return new Configurator();
    }

    public function isConfigured(): bool
    {
        return $this->isConfigured;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]) && !empty($this->data[$key]);
    }

    public function is(string $key): bool
    {
        return isset($this->data[$key]) && boolval($this->data[$key]) === true;
    }

    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->data[$key] : $default;
    }

    public function set(string $key, $value): self
    {
        if (!$this->has($key) || $this->get($key) != $value) {
            $this->isChanged    = true;
            $this->data[$key]   = $value;
        }

        return $this;
    }

    public function remove(string $key): self
    {
        $this->isChanged = true;

        $this->data[$key] = null;

        return $this;
    }

    public function setup(array $config): self
    {
        foreach ($config as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function __destruct()
    {
        if ($this->isChanged) {
            Option::create(
                collect($this->data)->map(fn ($value, $name) => ['name' => $name, 'value' => encode_string($value)])->all(),
                ['conflict' => ['name'], 'update' => ['value' => 'value']]
            );
            Option::Cache()->flush();
        }
    }
}
