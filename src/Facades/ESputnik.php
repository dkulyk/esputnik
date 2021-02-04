<?php
declare(strict_types=1);

namespace ESputnik\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ESputnik
 * @method static string[] availableDrivers()
 * @method static \ESputnik\ESputnik driver(string $driver = null)
 */
class ESputnik extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'esputnik';
    }
}
