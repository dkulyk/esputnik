<?php
declare(strict_types=1);

namespace ESputnik\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ESputnik
 * @package ESputnik\Facades
 */
class ESputnik extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'esputnik';
    }
}
