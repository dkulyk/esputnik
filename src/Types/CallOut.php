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
 * Class Callout
 *
 * @property string $calloutName
 * @property int $groupId
 * @property string $groupName
 * @property string $date
 * @property int $sent
 * @property int $delivered
 * @property int $errors
 */
class CallOut extends Object
{
    /**
     * @var string
     */
    protected $calloutName;

    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $groupName;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var int
     */
    protected $sent;

    /**
     * @var int
     */
    protected $delivered;

    /**
     * @var int
     */
    protected $errors;
}