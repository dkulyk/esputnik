<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class AllowedValues
 *
 * @property string[] $possibleValues
 * @property int      $minValue
 * @property int      $maxValue
 *
 * @link http://esputnik.com.ua/api/el_ns0_allowedValues.html
 */
class AllowedValues extends ESObject
{
    /**
     * @var string[]
     */
    protected $possibleValues = array();

    /**
     * @var int
     */
    protected $minValue;

    /**
     * @var int
     */
    protected $maxValue;
}
