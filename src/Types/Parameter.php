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
 * Class Parameter
 *
 * @property string $name
 * @property string $value
 *
 * @link http://esputnik.com.ua/api/ns1_parameter.html
 */
class Parameter extends Object
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