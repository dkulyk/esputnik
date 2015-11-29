<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\Object;

/**
 * Class AllowedValues
 *
 * @property string[] $possibleValues
 * @property int $minValue
 * @property int $maxValue
 */
class AllowedValues extends Object
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