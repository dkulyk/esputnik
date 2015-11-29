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
 * Class ContactField
 *
 * @property int $id
 * @property string $value
 */
class ContactField extends Object
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $value;
}