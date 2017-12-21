<?php
declare(strict_types=1);

namespace ESputnik\Types;

use ESputnik\ESObject;

/**
 * Class ContactField
 *
 * @property int    $id
 * @property string $value
 *
 * @link http://esputnik.com.ua/api/ns0_contactField.html
 */
class ContactField extends ESObject
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
