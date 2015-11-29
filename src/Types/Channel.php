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
 * Class Channel
 *
 * @property string $type
 * @property string $value
 */
class Channel extends Object
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $value;
}