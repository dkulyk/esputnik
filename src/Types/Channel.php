<?php
/**
 * This file is part of ESputnik API connector
 *
 * @package ESputnik
 * @license MIT
 * @author Dmytro Kulyk <lnkvisitor.ts@gmail.com>
 */

namespace ESputnik\Types;

use ESputnik\ESException;
use ESputnik\Object;

/**
 * Class Channel
 *
 * @property string $type
 * @property string $value
 *
 * @link http://esputnik.com.ua/api/el_ns0_channel.html
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

    /**
     * Set the type value
     *
     * @param string $type
     * @throws ESException
     */
    public function setType($type)
    {
        static $values = array(
            'email',
            'sms'
        );

        if (!in_array($type, $values)) {
            throw new ESException('Property type must be one of ' . implode(', ', $values) . ' values.');
        }

        $this->type = $type;
    }
}