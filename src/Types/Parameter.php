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