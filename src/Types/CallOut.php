<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class Callout
 *
 * @property string $calloutName
 * @property int    $groupId
 * @property string $groupName
 * @property string $date
 * @property int    $sent
 * @property int    $delivered
 * @property int    $errors
 *
 * @link http://esputnik.com.ua/api/el_ns0_callout.html
 */
class CallOut extends ESObject
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
