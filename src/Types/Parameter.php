<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Parameter
 *
 * @property string $name
 * @property string $value
 *
 * @link http://esputnik.com.ua/api/ns1_parameter.html
 */
class Parameter extends ESObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;
}
