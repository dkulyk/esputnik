<?php

declare(strict_types=1);

namespace ESputnik;

use Illuminate\Foundation\Application;
use Illuminate\Support\Manager;
use InvalidArgumentException;

/**
 * Class ESputnikManager
 * @mixin ESputnik
 */
class ESputnikManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->config->get('esputnik.default');
    }

    /**
     * Create a new driver instance.
     *
     * @param  string  $driver
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    protected function createDriver($driver)
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $config = $this->config->get("esputnik.accounts.{$driver}");

        if (empty($config) || ! \is_array($config)) {
            throw new InvalidArgumentException("Driver [$driver] not supported.");
        }

        return new ESputnik(
            $config['user'] ?? '',
            $config['password'] ?? '',
            $config['book'] ?? null,
            (bool) ($config['debug'] ?? false)
        );
    }

    public function availableDrivers(): array
    {
        return array_unique([
            ...array_keys($this->customCreators),
            ...array_keys(array_filter($this->config->get("esputnik.accounts"))),
        ]);
    }
}
